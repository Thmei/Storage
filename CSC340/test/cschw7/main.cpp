/*
  Name:         main.cpp
  Assignment:   HW7
  Author:       Michael Yu
  SFSU ID:      myu@mail.sfsu.edu
  Compiler:     GNU GCC Compiler (should also work on g++)
*/

#include <iostream>
#include "list.h"

using namespace std;

int main()
{
    List aList, bList;
    ListItemType dataItem, temp, action, choice, index;
    bool success;
    bool end = false;
    try
    {
        while(end != true)
        {
            cout << "\n\n1.  Insert to list.\n";
            cout << "2.  Remove from list.\n";
            cout << "3.  Retrieve value.\n";
            cout << "4.  Insert to front of list.\n";
            cout << "5.  Display reversed list.\n";
            cout << "6.  Reverse list.\n";
            cout << "7.  Copy list.\n";
            cout << "8.  Assign one list to another.\n";
            cout << "9.  Display lists.\n";
            cout << "10. Print test code.\n";
            cout << "0.  End program.\n";

            cout << "I SUGGEST YOU CHOOSE 10 TO TEST THE CODE ALL AT ONCE.\n";
            cout << "Enter your choice: ";
            cin >> action;
            cout << endl;

            switch(action)
            {
                case 0:
                end = true;
                break;

                case 1:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "Value:\n";
                    cin >> dataItem;
                    aList.insert(aList.getLength()+1, dataItem);
                    cout << "aList:\n";
                    cout << aList;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "Value:\n";
                    cin >> dataItem;
                    bList.insert(bList.getLength()+1, dataItem);
                    cout << "bList:\n";
                    cout << bList;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 2:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "aList :" << aList;
                    cout << endl;
                    cout << "Index to remove: ";
                    cin >> dataItem;
                    cout << endl;
                    aList.remove(dataItem);
                    cout << endl;
                    cout << "aList :" << aList;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "bList :" << bList;
                    cout << endl;
                    cout << "Index to remove: ";
                    cin >> dataItem;
                    cout << endl;
                    bList.remove(dataItem);
                    cout << endl;
                    cout << "bList :" << bList;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 3:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "Enter index: ";
                    cin >> index;
                    aList.retrieve(index, dataItem);
                    cout <<"The item is: "<< dataItem <<endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "Enter index: ";
                    cin >> index;
                    aList.retrieve(index, dataItem);
                    cout <<"The item is: "<< dataItem <<endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 4:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "Enter value: ";
                    cin >> dataItem;
                    aList.insert_front(dataItem);
                    cout << "aList is now: \n";
                    cout << aList;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "Enter value: ";
                    cin >> dataItem;
                    bList.insert_front(dataItem);
                    cout << "bList is now: \n";
                    cout << bList;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 5:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "aList: ";
                    aList.backwardsChoice(1);
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "bList: ";
                    bList.backwardsChoice(1);
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 6:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    aList.backwardsChoice(2);
                    cout << "aList: " << aList << endl;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    bList.backwardsChoice(2);
                    cout << "bList: " << bList << endl;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 7:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    List copyList(aList);
                    cout << "copyList: " << copyList << endl;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    List copyList(bList);
                    cout << "copyList: " << copyList << endl;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 8:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if (choice == 1) {
                    aList = bList;
                    cout << "aList = bList\n";
                    cout << "New aList: " << aList << endl;
                    cout << endl;
                    break;
                }else if (choice == 2){
                    bList = aList;
                    cout << "bList = aList\n";
                    cout << "New bList: " << bList << endl;
                    cout << endl;
                    break;
                }else{
                    cout << "Wrong entry.\n";
                    break;
                }

                case 9:
                cout << "1. aList\n2. bList\n";
                cout << "Choose a list: ";
                cin >> choice;
                cout << endl;
                if(choice == 1)
                {
                    cout << "aList: " << aList << endl;
                    cout << endl;
                    break;
                }
                else if(choice == 2)
                {
                    cout << "bList: " << bList << endl;
                    cout << endl;
                    break;
                }
                else
                {
                    cout << "Wrong entry.\n";
                    break;
                }

                case 10:
                aList.insert(1, 10);
                aList.insert(2, 20);
                aList.insert(3, 30);
                aList.insert(4, 40);
                aList.insert(5, 50);
                cout << "\naList:\n" << aList << endl;

                aList.remove(1);
                cout << "\naList after removing index 1:\n" << aList << endl;

                aList.retrieve(1, dataItem);
                cout << "\naList position 1's value is: " << dataItem << endl;

                aList.insert_front(100);
                cout << "\naList after inserting 100 to the front:\n" << aList << endl;

                cout << "\naList displayed backwards:\n";
                aList.backwardsChoice(1);
                cout << endl;

                cout << "\naList:\n" << aList << endl;
                aList.backwardsChoice(2);
                cout << "\naList's order modified to be backwards:\n" << bList << endl;

                cout << "\ncopyList is a copy of aList.";
                List copyList(aList);
                cout << "\ncopyList: " << copyList << endl;

                cout << "\nAssign bList to aList so...\n";
                bList = aList;
                cout << "\nbList = aList so,\nbList:\n" << bList << endl;

                cout << "\naList: " << aList << endl;
                cout << "bList: " << bList << endl;
                break;
            }
        }
    }
    catch(ListException & e1)
    {
        cerr << e1.what();
    }
    catch(ListIndexOutOfRangeException & e2)
    {
        //handling the exception here
    }
    catch(...)
    {
        //handling all the other exceptions here
    }
    return 0;
}
