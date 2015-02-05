/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 5 Problem 1
*/
#include "exception.h"

//function to return id of target
int getProductID(int ids[], string names[], int numProducts, string target) throw(exception_not_found)
{
	
	exception_not_found notFound; // create exception
	
	
	for (int i=0; i < numProducts; i++)
	{
		if (names[i] == target)
			return ids[i];
	}
	throw notFound; //throw exception if target id not found

	


}
