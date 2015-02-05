/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 4 Problem 1
*/
#ifndef POLY_H
#define POLY_H

class polynomial {
public:
    //variables to store degree and coefficients
	int *coeff, degree;
	//function protoypes of functions to be used		
    int get_data(); 
    int display(int *coeff, int degree);
    void addition(polynomial P1, polynomial P2);
    void substraction(polynomial P1, polynomial P2);
    void multiplication(polynomial P1, polynomial P2);
    void division(polynomial P1, polynomial P2);
};



#endif
