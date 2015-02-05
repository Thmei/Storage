#include <iostream>
#include <vector>

using namespace std;

int main(){

	int n,i,j, content,count = 0;
	//vector< vector<int> > nmatrix(n, vector<int>(n));
	vector<int> matrix;
	int nmatrix[100][100];
	cout << "Please state the value of N for your N-by-N matrix: ";
    cin >> n;
    
   
	
	cout << "Please enter in the contents of your first matrix:\n" << "Only integers are allowed.\n";
    for(int i = 0; i < n; i++)
    {
        for(int j = 0; j < n; j++)
        {
            cout << count << ": ";
            cin >> content;
            //matrix[i][j] = content;
            nmatrix[i][j] = content;
            count++;
        }
    }
    
	
	 cout << "This is your first matrix: \n";
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
