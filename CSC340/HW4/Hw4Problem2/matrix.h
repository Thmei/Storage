#ifndef MATRIX_H
#define MATRIX_H

#include <vector>




class mcalc{
	public:
		int n,m,a,b;
	
		//std::vector< std::vector<int> > nmatrix(n, std::vector<int>(n)); //this is the 2D Vector that SHOULD HAVE worked but did not
		// so i made a bunch of int arrays instead
		int nmatrix[100][100]; // Array for first matrix
		int mmatrix[100][100]; // Array for second matrix 
		int product[100][100]; // Array for Matrix for product
		int sum[100][100];     // Array for Matrix for Sum NOT USED
		int difference[100][100]; // Array for Matrix for negation
		
		int getN(); // function to get N for NxN dimension for Matrix
		int getN2();
		int input(); // gets data for Matrix
		int input2();
		int display(int n); //Displays the matrix
		int display2(int n);
		int retrieve(int n); //Retrieving data from one location of matrix
		int retrieve2(int n);
		int sub(int n); //function for negation
		int mult(int n);//function for multiplication
		int setValue(int n); //function to Set a value at a specific location
		int setValue2(int n);
		
	
	
	
	
};
#endif
