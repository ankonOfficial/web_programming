#include <stdio.h>

int main()
{
    FILE *file;
    int n, W;

    file = fopen("Knapsack_input.txt", "r");
    if (file == NULL)
    {
        printf("File open error\n");
        return 1;
    }

    fscanf(file, "%d", &n);
    fscanf(file, "%d", &W);

    int wt[50], val[50];

    for (int i = 0; i < n; i++)
    {
        fscanf(file, "%d %d", &wt[i], &val[i]);
    }

    fclose(file);

    int dp[50][50];

    for (int i = 0; i <= n; i++)
    {
        for (int w = 0; w <= W; w++)
        {
            if (i == 0 || w == 0)
            {
                dp[i][w] = 0;
            }
            else if (wt[i - 1] <= w)
            {
                int take = val[i - 1] + dp[i - 1][w - wt[i - 1]];
                int skip = dp[i - 1][w];

                if (take > skip)
                    dp[i][w] = take;
                else
                    dp[i][w] = skip;
            }
            else
            {
                dp[i][w] = dp[i - 1][w];
            }
        }
    }

    printf("Maximum value: %d\n", dp[n][W]);

    int i = n, w = W;
    int selected[50];
    int count = 0;

    while (i > 0 && w > 0)
    {
        if (dp[i][w] != dp[i - 1][w])
        {
            selected[count] = i;
            count++;
            w = w - wt[i - 1];
        }
        i--;
    }

    printf("Selected items: ");
    for (int j = count - 1; j >= 0; j--)
    {
        printf("Item %d", selected[j]);
        if (j > 0) printf(", ");
    }

    printf("\n");

    return 0;
}
