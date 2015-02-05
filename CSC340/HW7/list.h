#ifndef LIST_H
#define LIST_H
 
#include "listexception.h"
#include <string>
#include <iostream>
 
const int MAX_LIST = 20;
typedef int ListItemType;
 

class List
{
    public:
        List();
        int huy;
        int *nums;
        //creating the array of umbers
		void create();
        
		//display backwards
		int printBackward( int size);
  
        // Converts string into list
        void userInputList(string uiList);
 
        // Gets largest value in list
        int getLargest();
 
        // Gets kth largest value in list
        int getKthLargest(int k);
        
        //quicksort
        void quickSort( int a[], int first, int last ); 
        int pivot(int a[], int first, int last); 
        void swap(int& a, int& b);
        void swapNoTemp(int& a, int& b);
        void print(int a[], const int& size);
       
       
        int displayBackward(int size);
 
    private:
        
        ListItemType items[MAX_LIST];
        string name;
		int getLargest(int count, int tempLargest);
        int getKthLargest(int k, ListItemType arr[], int first, int last);
        int size;
        int translate(int index) const;
}; 

 
#endif 
