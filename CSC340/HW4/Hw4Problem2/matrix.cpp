#include <iostream>
#include <vector>
#include "matrix.h"

using namespace std;
//function to get N for NxN Dimension matrix
int mcalc::getN(){
	cout << "Please state the value of N for your N-by-N matrix: ";
    cin >> n;
	
	return 0;
}
int mcalc::getN2(){
	cout << "Please enter same value N as you did earlier or errors will occur: ";
    cin >> n;
	
	return 0;
	
}

//getting user input
int mcalc::input() {
    int i =0 ,j = 0,count = 1,content = 0;
 
    
   	//vector< vector<int> > nmatrix(n, vector<int>(n)); //ignore this
   	
    for(int i = 0; i < n; i++)
    {
        for(int j = 0; j < n; j++)
        {
            cout << count << ": ";
            cin >> content;
            nmatrix[i][j] = content;
            
            count++;
        }
    }
    
    return 0;
}
//getting user input for matrix 2
int mcalc::input2() {
    int i =0 ,j = 0,count = 1,content = 0;
 
    
   	//vector< vector<int> > nmatrix(n, vector<int>(n)); //ignore this
   	
    for(int i = 0; i < n; i++)
    {
        for(int j = 0; j < n; j++)
        {
            cout << count << ": ";
            cin >> content;
            mmatrix[i][j] = content;
            
            count++;
        }
    }
    
    return 0;
}
// display matrix 1
int mcalc::display(int n) {
    int i, j;
   // vector< vector<int> > nmatrix(n, vector<int>(n)); //ignore this
    cout << "This is your matrix: \n";
	
    for(i = 0; i < n; i++)
    {
        for(j = 0; j < n; j++)
        {
            cout << nmatrix[i][j] << " ";
        }
        cout << endl;
    }
    return 0;
}
//display matrix 2
int mcalc::display2(int n) {
    int i, j;
   
    cout << "This is your matrix: \n";
	
    for(i = 0; i < n; i++)
    {
        for(j = 0; j < n; j++)
        {
            cout << mmatrix[i][j] << " ";
        }
        cout << endl;
    }
    return 0;
}
//retrieving value at location for matrix 1
int mcalc::retrieve(int n){
	int row,col;
	cout << "What value would you like to know from First Matrix? \n";
	cout << "Row 1 = 0\n";
	cout << "What row would you like to check? \n";
	cin >> row;
	cout << "What col would you like to check? \n";
	cin >> col;
	cout << "The value is : "<< nmatrix[row][col]<< endl;
}
//retrieving value at location for matrix 2
int mcalc::retrieve2(int n){
	int row,col;
	cout << "What value would you like to know from second Matrix? \n";
	cout << "Row 1 = 0\n";
	cout << "What row would you like to check? \n";
	cin >> row;
	cout << "What col would you like to check? \n";
	cin >> col;
	cout << "The value is : "<< mmatrix[row][col]<< endl;
}
//set value for location in matrix 1
int mcalc::setValue(int n){
	int row, col,num;
	cout << "Setting a new value to a location for First Matrix \n ";
	cout << "Row 1 = 0\n";
	cout << "Which row would you like to set? \n";
	cin  >> row;
	cout << "which col would you like to check? \n";
	cin >> col;
	cout << "what value would you like to set this location with? \n";
	cin >> num;
	nmatrix[row][col]=num;
	
}
//set value for location in matrix 2
int mcalc::setValue2(int n){
	int row, col,num;
	cout << "Setting a new value to a location for First Matrix \n ";
	cout << "Row 1 = 0\n";
	cout << "Which row would you like to set? \n";
	cin  >> row;
	cout << "which col would you like to check? \n";
	cin >> col;
	cout << "what value would you like to set this location with? \n";
	cin >> num;
	mmatrix[row][col]=num;
	
}
//matrix negation function
int mcalc::sub(int n){
	
	cout << "This is the difference of the two Matrices: \n";
	for (int row = 0; row < n; row++) {
        for (int col = 0; col < n; col++) {
            // Multiply the row of A by the column of B to get the row, column of product.
            	
                difference[row][col] = nmatrix[row][col] - mmatrix[row][col];
            
            cout << difference[row][col] << "  ";
        }
        cout << "\n";
    }
}
//matrix product function
int mcalc::mult(int n){
	cout << "This is the Product of the two Matrices: \n";
	for (int row = 0; row < n; row++) {
        for (int col = 0; col < n; col++) {
            // Multiply the row of A by the column of B to get the row, column of product.
            for (int inner = 0; inner < n; inner++) {
                product[row][col] += nmatrix[row][inner] * mmatrix[inner][col];
            }
            cout << product[row][col] << "  ";
        }
        cout << "\n";
    }
}



