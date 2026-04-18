#include <stdio.h>
#include <string.h>

#define MAX 100

int max(int a, int b) {
    if (a > b)
        return a;
    else
        return b;
}

int lcs(char X[], char Y[], int m, int n) {

    int L[MAX][MAX];

    // Build LCS table
    for (int i = 0; i <= m; i++) {
        for (int j = 0; j <= n; j++) {

            if (i == 0 || j == 0)
                L[i][j] = 0;

            else if (X[i - 1] == Y[j - 1])
                L[i][j] = L[i - 1][j - 1] + 1;

            else
                L[i][j] = max(L[i - 1][j], L[i][j - 1]);
        }
    }

    return L[m][n];
}

int main() {

    char X[] = "ABCBDAB";
    char Y[] = "BDCAB";

    int m = strlen(X);
    int n = strlen(Y);

    int result = lcs(X, Y, m, n);

    printf("Length of LCS: %d\n", result);

    return 0;
}