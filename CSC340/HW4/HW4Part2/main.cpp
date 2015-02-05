#include <iostream>
#include <vector>
#include "vectorADT.h"

using namespace std;

int main(int argc, char * const argv[])
{
//Ask the end user to input a square matrix 
vector < vector <int> > matrix;
int size = 0;
int num = 1;
cout << "What is the size od your square matrix? : ";
cin >> size;
for (int i = 0; i < size; i++)
{
cout << "Row " << i+1 << endl;
vector <int> col;
for (int j = 0; j <size; j++)
{
cout << " Colomn " << j + 1 << " : ";
cin >> num;
col.push_back(num);
}
matrix.push_back(col);
}

//Test: constructor vectorADT(vector< vector <int> >);
vectorADT matrix2(matrix);
cout << endl << "Your matrix is " << endl;
//cout << matrix2(matrix);


//Test: int retrieve(int, int);
cout << endl << "Retrieve value from : " << endl;
int col, row;
cout << "Row :";
cin >> row;
cout << "Column :";
cin >> col;
cout << "The value of ( " << row << ", " << col <<" ) is "<<matrix2.retrieve(row, col) << endl;

//Test: void setValue(int, int, int);
cout << endl << "Set a value at : " << endl;
int value;
cout << "Row :";
cin >> row;
cout << "Column :";
cin >> col;
cout << "and the new value is : ";
cin >> value;
matrix2.setValue(row, col, value);
//cout<<matrix2;

return 0;
}

