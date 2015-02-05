#include <iostream>
#include <vector>

using namespace std;

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

int main() {
	
	//initializes values
    int n = 0, m = 0, i = 0, j = 0, k = 0, l = 0 ,count = 1, content1 = 0, content2 = 0; 
 
    cout << "Problem #2: \n";
 
    //Asks user for matrix size; then creates matrix
    cout << "Please state the value of N for your N-by-N matrix: ";
    cin >> n;
    vector< vector<int> > nmatrix(n, vector<int>(n));
 	m=n;
 	vector< vector<int> > mmatrix(n, vector<int>(n));
 	vector< vector<int> > product(n, vector<int>(n));
 	vector< vector<int> > sum(n, vector<int>(n));
 	vector< vector<int> > difference(n, vector<int>(n));
 	
   
 
    //Matrix 1
    cout << "Please enter in the contents of your first matrix:\n" << "Only integers are allowed.\n";
    for(int i = 0; i < n; i++)
    {
        for(int j = 0; j < n; j++)
        {
            cout << count << ": ";
            cin >> content1;
            nmatrix[i][j] = content1;
            count++;
        }
    }
    //Matrix 2 
    cout << "Please enter in the contents of your second matrix:\n" << "Only integers are allowed.\n";
    for(int k = 0; k < n; k++)
    {
        for(int l = 0; l < n; l++)
        {
            cout << count << ": ";
            cin >> content2;
            mmatrix[k][l] = content2;
            count++;
        }
    }
 
    
 
    //Displays matrix to user
    cout << "This is your first matrix: \n";
    for(i = 0; i < n; i++)
    {
        for(j = 0; j < n; j++)
        {
            cout << nmatrix[i][j] << " ";
        }
        cout << endl;
    }
    
     //Displays matrix to user
    cout << "This is your second matrix: \n";
    for(k = 0; k < n; k++)
    {
        for(l = 0; l < n; l++)
        {
            cout << mmatrix[k][l] << " ";
        }
        cout << endl;
    }
	
	//Matrix Multiplication
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
	
	//Matrix Addition
	cout << "This is the sum of the two Matrices: \n";
	for (int row = 0; row < n; row++) {
        for (int col = 0; col < n; col++) {
            // Multiply the row of A by the column of B to get the row, column of product.
            
                sum[row][col] = nmatrix[row][col] + mmatrix[row][col];
            
            cout << sum[row][col] << "  ";
        }
        cout << "\n";
    }
	
	//Matrix Subtraction
	cout << "This is the difference of the two Matrices: \n";
	for (int row = 0; row < n; row++) {
        for (int col = 0; col < n; col++) {
            // Multiply the row of A by the column of B to get the row, column of product.
            
                difference[row][col] = nmatrix[row][col] - mmatrix[row][col];
            
            cout << difference[row][col] << "  ";
        }
        cout << "\n";
    }
	
	
	
	return 0;
}
