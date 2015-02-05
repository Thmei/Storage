/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 5 Problem 1
*/
#include <iostream>
#include "exception.h"

using namespace std;


int main() // Sample code to test the getProductID function
{
	//setting up the ID's of each product
	int productIds[]= {-100, -52, 899, -10, 6546513};
	string products[] = { "computer", "flash drive", "mouse", "printer", "camera" };
	cout << "Each word is associated with a number. \n";
	cout << "computer : -100\nflash drive : -52\nmouse : 899\nprinter : -10\ncamera : 6546513\n";
	cout << "Program will try to get the product ID of the target\n";
	cout << "Will return with an error message if target does not exist\n";
 	try{
	cout << getProductID(productIds, products, 5, "mouse") << endl; // test multiple targets for ID return
	cout << getProductID(productIds, products, 5, "camera") << endl;
	cout << getProductID(productIds, products, 5, "printer") << endl;
	cout << getProductID(productIds, products, 5, "computer") << endl;
	cout << getProductID(productIds, products, 5, "laptop") << endl; // "laptop" does not exist in products[] go to catch
	
	
	}catch(exception & e){
		cout << "Exception caught: "<< e.what() << endl; //target not found, print out exception error
	}
	return 0;
}

