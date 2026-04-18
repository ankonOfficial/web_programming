#include <stdio.h>

#define MAX 10

int graph[MAX][MAX];
int visited[MAX];
int n;

void dfs(int node) {
    visited[node] = 1;
    printf("%d ", node);

    for (int i = 0; i < n; i++) {
        if (graph[node][i] == 1 && visited[i] == 0) {
            dfs(i);
        }
    }
}

int main() {
    n = 4;

    graph[0][1] = 1; graph[1][0] = 1;
    graph[0][2] = 1; graph[2][0] = 1;
    graph[1][2] = 1; graph[2][1] = 1;
    graph[2][3] = 1; graph[3][2] = 1;

    printf("DFS Traversal: ");
    dfs(0);
    printf("\n");

    return 0;
}
