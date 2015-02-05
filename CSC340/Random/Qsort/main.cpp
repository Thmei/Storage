#include <iostream>
 
void quickSort(int a[], int first, int last);
int pivot(int a[], int first, int last);
void swap(int& a, int& b);
void swapNoTemp(int& a, int& b);
void print(int array[], const int& N);
 
using namespace std;
 
int main()
{
    int test[] = { 7, -13, 1, 3, 10, 5, 2, 4 };
    int N = sizeof(test)/sizeof(int);
 
    cout << "Size of test array :"  << N << endl;
 
    cout << "Before sorting : " << endl;
    print(test, N);
 
    quickSort(test, 0, N-1);
 
    cout << endl << endl << "After sorting : " << endl;
    print(test, N);
     
    return 0;
}
 

void quickSort( int a[], int first, int last ) 
{
    int pivotElement;
 
    if(first < last)
    {
        pivotElement = pivot(a, first, last);
        quickSort(a, first, pivotElement-1);
        quickSort(a, pivotElement+1, last);
    }
}
 

int pivot(int a[], int first, int last) 
{
    int  p = first;
    int pivotElement = a[first];
 
    for(int i = first+1 ; i <= last ; i++)
    {
        /* If you want to sort the list in the other order, change "<=" to ">" */
        if(a[i] <= pivotElement)
        {
            p++;
            swap(a[i], a[p]);
        }
    }
 
    swap(a[p], a[first]);
 
    return p;
}
 

void swap(int& a, int& b)
{
    int temp = a;
    a = b;
    b = temp;
}
 

void swapNoTemp(int& a, int& b)
{
    a -= b;
    b += a;// b gets the original value of a
    a = (b - a);// a gets the original value of b
}
 
void print(int a[], const int& N)
{
    for(int i = 0 ; i < N ; i++)
        cout << "array[" << i << "] = " << a[i] << endl;
} 
