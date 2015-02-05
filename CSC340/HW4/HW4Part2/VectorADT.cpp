#include "vectorADT.h"

//Default Constructor 

vectorADT::vectorADT()
{
myCol.resize(0);
myMatrix.push_back(myCol);
}

//Constructor that creates a matrix based on the given matrix
vectorADT::vectorADT(vector < vector <int> > matrix)
{
int size = 0;
for (int i = 0; i < matrix.size(); i++)
{
vector <int> tempCol;
for (int j = 0; j < matrix.size(); j++)
{
tempCol.push_back(matrix[i][j]);
}
size++;
myMatrix.push_back(tempCol);
}
mySize = size;
}


//Initializes matrix with all the element 0
void vectorADT::initialize(int col, int row)
{
myMatrix.clear();
for (int i = 0; i < col; i++)
{
myCol.clear();

for (int j = 0; j < row; j++)
{
myCol.push_back(0);
}
myMatrix.push_back(myCol);
}
}

//Retrieves an elemetn at (col, row)
int vectorADT::retrieve(int col, int row)
{ 
if (col > myMatrix.size() || row > myMatrix.size())
{
cout << "Out of range. Returns 0." << endl;
return(0);
}


return(myMatrix[col - 1][row - 1]);
}

//Sets a value of (col, row)
void vectorADT::setValue(int col, int row, int value)
{
vector < vector <int> > tempMatrix;

if (col > myMatrix.size() || row > myMatrix.size())
{
cout << "Out of range. Matrix was not modified." << endl;
}
 
for (int i = 0; i < myMatrix.size(); i++)
{
vector <int> tempCol;
for (int j = 0; j < myMatrix.size(); j++)
{
if (i == col - 1 && j == row - 1) tempCol.push_back(value);
tempCol.push_back(myMatrix[i][j]);
}
tempMatrix.push_back(tempCol);
}
myMatrix = tempMatrix;
}

void vectorADT::transpose()
{

}

