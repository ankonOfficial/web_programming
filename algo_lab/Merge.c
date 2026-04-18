#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>


void merge(int arr[], int left, int mid, int right, long long *comparisons)
{
    int n1 = mid - left + 1;
    int n2 = right - mid;

    int L[n1], R[n2];

    for (int i = 0; i < n1; i++)
        L[i] = arr[left + i];

    for (int j = 0; j < n2; j++)
        R[j] = arr[mid + 1 + j];

    int i = 0, j = 0, k = left;

    while (i < n1 && j < n2)
    {
        (*comparisons)++;
        if (L[i] <= R[j])
            arr[k++] = L[i++];
        else
            arr[k++] = R[j++];
    }

    while (i < n1)
        arr[k++] = L[i++];

    while (j < n2)
        arr[k++] = R[j++];
}


void mergesort(int arr[], int n, long long *comparisons)
{
    for (int size = 1; size <= n - 1; size = 2 * size)
    {
        for (int start = 0; start < n - 1; start += 2 * size)
        {
            int mid = start + size - 1;
            int end = (start + 2 * size - 1 < n - 1)
                        ? start + 2 * size - 1
                        : n - 1;

            if (mid < end)
                merge(arr, start, mid, end, comparisons);
        }
    }
}

int read_input_file(const char *path, int **out_arr, int *out_count)
{
    FILE *fp = fopen(path, "r");
    if (fp == NULL)
        return 0;

    int capacity = 128;
    int count = 0;
    int *arr = (int *)malloc(sizeof(int) * capacity);
    if (arr == NULL)
    {
        fclose(fp);
        return 0;
    }

    int value;
    while (fscanf(fp, "%d", &value) == 1)
    {
        if (count == capacity)
        {
            capacity *= 2;
            int *new_arr = (int *)realloc(arr, sizeof(int) * capacity);
            if (new_arr == NULL)
            {
                free(arr);
                fclose(fp);
                return 0;
            }
            arr = new_arr;
        }
        arr[count++] = value;
    }

    fclose(fp);
    *out_arr = arr;
    *out_count = count;
    return 1;
}


int main()
{
    int *input = NULL;
    int total = 0;

    if (!read_input_file("input.txt", &input, &total))
    {
        printf("Error: Cannot read input file\n");
        return 1;
    }

    const int sizes[] = {100, 500, 1000, 5000};
    const int sizes_count = (int)(sizeof(sizes) / sizeof(sizes[0]));

    FILE *csv = fopen("results.csv", "w");
    if (csv == NULL)
    {
        printf("Error: Cannot write results.csv\n");
        free(input);
        return 1;
    }

    fprintf(csv, "n,time_ms,comparisons\n");
    printf("n\ttime_ms\tcomparisons\n");

    for (int i = 0; i < sizes_count; i++)
    {
        int n = sizes[i];
        if (n > total)
        {
            printf("Skipping n=%d (only %d values in input.txt)\n", n, total);
            continue;
        }

        int *arr = (int *)malloc(sizeof(int) * n);
        if (arr == NULL)
        {
            printf("Error: Memory allocation failed\n");
            fclose(csv);
            free(input);
            return 1;
        }

        memcpy(arr, input, sizeof(int) * n);

        long long comparisons = 0;
        clock_t start = clock();
        mergesort(arr, n, &comparisons);
        clock_t end = clock();

        double elapsed_ms = (double)(end - start) * 1000.0 / CLOCKS_PER_SEC;

        fprintf(csv, "%d,%.3f,%lld\n", n, elapsed_ms, comparisons);
        printf("%d\t%.3f\t%lld\n", n, elapsed_ms, comparisons);

        free(arr);
    }

    fclose(csv);
    free(input);
    return 0;
}

