#include <stdio.h>
#include <string.h>

int main()
{
    FILE *in, *out;

    char X[100];
    char Y[100];

    in = fopen("LCS_input.txt", "r");
    if (in == NULL)
        return 1;

    fgets(X, sizeof(X), in);
    fgets(Y, sizeof(Y), in);

    fclose(in);

    X[strcspn(X, "\n")] = '\0';
    Y[strcspn(Y, "\n")] = '\0';

    int m = strlen(X);
    int n = strlen(Y);

    int dp[101][101];

    int i, j;


    
    for (i = 0; i <= m; i++)
    {
        for (j = 0; j <= n; j++)
        {
            if (i == 0 || j == 0)
            {
                dp[i][j] = 0;
            }

            else if (X[i - 1] == Y[j - 1])
            {
                dp[i][j] = dp[i - 1][j - 1] + 1;
            }

            else
            {
                if (dp[i - 1][j] > dp[i][j - 1])
                {
                    dp[i][j] = dp[i - 1][j];
                }
                else
                {
                    dp[i][j] = dp[i][j - 1];
                }
            }
        }
    }



    int length = dp[m][n];

    char lcs[101];
    lcs[length] = '\0';

    i = m;
    j = n;



    while (i > 0 && j > 0)
    {
        if (X[i - 1] == Y[j - 1])
        {
            lcs[length - 1] = X[i - 1];

            i--;
            j--;
            length--;
        }

        else if (dp[i - 1][j] > dp[i][j - 1])
        {
            i--;
        }

        else
        {
            j--;
        }
    }



    out = fopen("LCS_output.txt", "w");
    if (out == NULL)
        return 1;

    fprintf(out, "Length of the Longest Common Subsequence: %d\n", dp[m][n]);
    fprintf(out, "Longest Common Subsequence: \"%s\"\n", lcs);

    fclose(out);

    return 0;
}