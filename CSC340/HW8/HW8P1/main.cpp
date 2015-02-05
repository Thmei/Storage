#include <iostream>
#include <vector>
#include "vector.h"
using namespace std;


int main() {
	int choice;
	Vector myVector;

	cout << "                             ---Vector ADT Testing---\n";
	while(1){
	cout << "                           ---Please select an option---\n";
	cout << "                                  1.Display\n";
	cout << "                                  2.Push_Back\n";
	cout << "                                  3.Pop_Back\n";
	cout << "                                  4.Size\n";
	cout << "                                  5.Capacity\n";
	cout << "                                  6.Resize\n";
	cout << "                                  7.IsEmpty\n";
	cout << "                                  8.Erase\n";
	cout << "                                  9.Insert\n";
	cout << "                                  10.Shrink\n";
	cout << "                                  0.Exit\n";
	cout << "                           ---Enter Your Choice---\n                                      ";
	cin >> choice;
	switch(choice){
		case 1: 
			myVector.display();
			cout << endl;
			break;
		case 2:
			myVector.psh_back();
			myVector.display();
			cout << endl;
			break;
		case 3:
			myVector.pop_back();
			myVector.display();
			cout << endl;
			break;
		case 4:
			myVector.Size();
			break;
		case 5:
			myVector.capacity();
			break;	
		case 6:
			myVector.resize();
			break;
		case 7:
			myVector.isEmpty();
			break;
		case 8:
			myVector.erase();
			myVector.display();
			break;
		case 9:
			myVector.insert();
			myVector.display();
			cout << endl;
			break;
		case 10:
			myVector.shrink_to_fit();
			break;					
		case 0:
		cout << "Thank you" << endl;
		exit(0);
		
	}
}

	return 0;
}

/*
dispaly .. 
capacity..
empty..
erase..
insert..
popback..
pushback..
resize..
shrink
size..
*/
