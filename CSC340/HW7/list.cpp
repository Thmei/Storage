#include <iostream>
#include <sstream>
#include "list.h"  
 
List::List(): size(0), name("")
{
 
}  //default constructor
 


// Accepts a set of numbers and creates a list of these numbers
void List::userInputList(string uiList)
{
    int userString, temp;
    stringstream ss(stringstream::in | stringstream::out);
    ss << uiList;
    int i = 0;
    while(ss >> userString)
    {
        items[i] = userString;
        i++;
        size++;
    }
}
//creates the array of numbers 
void List::create()
{
    cout << "Enter size of array: ";
    cin >> huy;
    nums = new int[huy]; //runtime fixed size array
     
    for(int i = 0; i < huy; i++ )
    {
        cout << "Enter content of index [" << i << "] : ";
        cin >> nums[i];
    }       
}
//displays the array backwards
int List::printBackward(int huy)
{
    int index = huy;
    if(index == 0)
        return -1;
    else
        cout << nums[index-1] << " ";
        return (printBackward(int (huy-1)));
         
}

//gets the largest value
int List::getLargest()
{
    return getLargest(0, items[0]);
}
 
//gets the largets value
int List::getLargest(int count, int tempLargest)
{
    if(size == 1)
    {
        return tempLargest;
    }
    else if(count == size)
    {
        return tempLargest;
    }
    else if(tempLargest < items[count])
    {
        return getLargest(++count, items[count]);
    }
    else
    {
        return getLargest(++count, tempLargest);
    }
}
 
// Translates k and calls getKthLargest
int List::getKthLargest(int k)
{
    k = k - 1;
    return getKthLargest(k, items, 0, size - 1);
}
 
// get kth largest value in list
int List::getKthLargest(int k, int arr[], int first, int last)
{
    int count = first;
    int pivotIndex = (first + last) / 2;
    int temp = arr[last];
    arr[last] = arr[pivotIndex];
    arr[pivotIndex] = temp;
    pivotIndex = last;
 
    for(int i = first; i < last; i++)
    {
        if(arr[i] >= arr[pivotIndex])
        {
            int temp = arr[count];
            arr[count] = arr[i];
            arr[i] = temp;
            count++;
        }
    }
 
    temp = arr[count];
    arr[count] = arr[pivotIndex];
    arr[pivotIndex] = temp;
    pivotIndex = count;

    if(pivotIndex == k)
    {
        return arr[pivotIndex];
    }
    else if(k > pivotIndex)
    {
        first = pivotIndex + 1;
        return getKthLargest(k, arr, first, last);
    }
    else
    {
        last = pivotIndex - 1;
        return getKthLargest(k, arr, first, last);
    }
}
//quicksort - pivot, near the middle for the pivot point to search first half and second half
int List::pivot(int a[], int first, int last) 
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
//quick sort 
void List::quickSort( int a[], int first, int last ) 
{
    int pivotElement;
 
    if(first < last)
    {
        pivotElement = pivot(a, first, last);
        quickSort(a, first, pivotElement-1);
        quickSort(a, pivotElement+1, last);
    }
}
 
//swapping palces
void List::swap(int& a, int& b)
{
    int temp = a;
    a = b;
    b = temp;
}
 
//swapping places
void List::swapNoTemp(int& a, int& b)
{
    a -= b;
    b += a;// b gets the original value of a
    a = (b - a);// a gets the original value of b
}

//print 
void List::print(int a[], const int& size)
{
    for(int i = 0 ; i < huy ; i++)
        cout << a[i] << " ";
}  




