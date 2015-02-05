//Thomas X Mei  CSC 340  911647469

#include <iostream>
#include <string>
#include <vector>
using namespace std;

int selectionSort();

vector<int> v;
int main(){
	//Format: vector<DataType> nameOfVector, just a note for myself
	int a,b,c,d,e,f;
	
	// prompt the user to enter numbers, in this case 2 and store it into variables
	cout << "Enter six numbers!" << endl;
	cout << "Enter first number:";
	cin >> a;
	v.push_back(a);
	cout << "Enter second number:";
	cin >> b;
	v.push_back(b);
	cout << "Enter third number: ";
	cin >> c;
	v.push_back(c);
	cout << "Enter fourth number: ";
	cin >> d;
	v.push_back(d);
	cout << "Enter fifth number: ";
	cin >> e;
	v.push_back(e);
	cout << "Enter sixth number: ";
	cin >> f;
	v.push_back(f);
	
	cout << "The numbers you have entered are : " ;
	//for loop to show numbers chosen
	for ( int i = 0; i< v.size(); i++ ){
		cout << v[i] << " ";
	}  
	cout << endl;
	
	//cout << "The numbers you have chosen are: " << a << " " << b << " " << c << " "<< d << " " << e << " " << f << " " << endl; 
	
	selectionSort();	
	return 0;
}
//function to sort the numbers and order them by order of increasing
int selectionSort(){
	for (int i =0; i<v.size() -1; i++ ){
		int lowest = i;
		for (int g = i +1; g<v.size(); g++){
			if(v[lowest] > v[g]){
				lowest = g;
			}
		}
		// put the lowest remaining element in 
		int iSwap = v[lowest];
		v[lowest] = v[i];
		v[i] = iSwap;
	}
	cout << "The numbers after being sorted : ";
		for ( int i = 0; i< v.size(); i++ ){
		cout << v[i] << " ";
}
}


