#include <iostream>
#include <vector>
#ifndef VECTORADT_H
#define VECTORADT_H

using namespace std;

class vectorADT
{
private:
int mySize;
vector <int> myCol;
vector < vector <int> > myMatrix;

public:
/*** Constructor ***/
vectorADT();
//initializes a matrix by using values stored in a vector of vectors.
vectorADT(vector< vector <int> >);

void initialize(int col, int row);
int retrieve(int col, int row);
void setValue(int col, int row, int value);
void transpose();




};
#endif
