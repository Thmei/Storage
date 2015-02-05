/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 4 Problem 2
*/
#include <iostream>
#include "matrix.h"

using namespace std;

//runs all the functions from other .cpp file

int main() {
	mcalc M1, M2, M3;
	cout << "Square Matrices!!! \n";
	M1.getN();
	M1.input();
	M1.display(M1.n);
	M2.getN2();
	M2.input2();
	M2.display2(M2.n);
	M1.retrieve(M1.n);
	M2.retrieve2(M2.n);
	M1.setValue(M1.n);
	M1.display(M1.n);
	M2.setValue2(M2.n);
	M2.display2(M2.n);
	M1.sub(M1.n);
	M2.mult(M1.n);
	
	
	
	return 0;
}
