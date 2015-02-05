/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 5 Problem 1
*/
#ifndef EXCEPTION_H
#define EXCEPTION_H

#include <stdexcept>
#include <iostream>

using namespace std;

//exception class to be used if error occurs
class exception_not_found: public exception{
	public:
		virtual const char* what() const throw(){
			return "ERROR! TARGET NOT FOUND!";
		}
};

//prototypes
int getProductID(int ids[], string names[], int numProducts, string target) throw(exception_not_found);
#endif
