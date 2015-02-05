#include <iostream>
#include <string>
#include "list.h" 
 
using namespace std;
 
int main()
{
	//STRINGSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
    List aList, name;
    string listA, number;
    int k;
 
    try
    {
       
        aList.create();
        cout <<"Array displayed Backwards: ";
        aList.printBackward(aList.huy);
        aList.quickSort(aList.nums, 0, aList.huy-1);
        cout << "\nArray after Quick Sort: ";
        
        aList.print(aList.nums, aList.huy);
 
        // Ignores the previous word input when entering integer list
        cin.ignore(256, '\n');
 
        // prompt user to enter a bunch of values
        cout << "\nPlease input integer values for the list (Use spaces for each new number): \n";
        getline(cin, listA);
        aList.userInputList(listA);
        
        
 
        //print to the screen the largest value 
        cout << "The largest value in your list is: " << aList.getLargest() << endl;
 
        //promt user for value of k to check kth biggest intger
        cout << "To find the kth largest value, please enter a value for k: \n";
        cin >> k;
        cout << "\nThe kth largest value in your list is: " << aList.getKthLargest(k) << endl;
 
    }
    catch(ListException& e)
    {
        cout << e.what();
    }
    return 0;
}
