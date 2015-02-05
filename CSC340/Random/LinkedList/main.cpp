#include <iostream>
#include <cstdlib>
#include "list.h"

using namespace std;

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

int main() {
		
	list newList;
	
	newList.AddNode(3);
	newList.AddNode(5);
	newList.AddNode(6);
	newList.PrintList();
	newList.DeleteNode(7);
	newList.PrintList();
	newList.DeleteNode(5);
	newList.PrintList();
	newList.DeleteNode(3);
	newList.PrintList();	

	return 0;
}
