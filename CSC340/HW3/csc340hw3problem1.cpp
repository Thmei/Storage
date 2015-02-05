/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 3 Problem 1
*/

#include <iostream>
#include<fstream>
#include<string>
#include<vector>
using namespace std;

vector<int> v;

int main(){
	
	cout<<"This will read from file1.txt and insert the missing numbers into the appropriate location"<<endl;
	cout<<"The current vector contains: \n";
	
	
	//initializations
	int g;
	int num;
	
	//reading the input file
	ifstream file("file1.txt");
	
	//storing the contents of file into vector
	while(file >>num){
		v.push_back(num);
	}
	
	//print out contents of vector
	//mainly to just check if the vector push back worked
	//feel free to ignore
	for (int i=0; i<53 ; i++ )
	cout << v[i] << endl;
	
	
	
	ofstream openfile("file1.txt", ios::in);
	if(openfile.is_open()) //as long as the file is open
	{
			 
		openfile.seekp(5*24); // seek to location where 24 end, each line occupied 5 spaces, 24 lines
				
		for (g=25; g<71;g++){	//inserts the missing numbers into file1.txt with appropriate spacing
			openfile << "  " << g<<endl;
			
		}
		
		for(int i=24; i<53;i++)	//inserts the remaining numbers since it was previously overwritten
			openfile << "  "<< v[i]<<endl;
		
	}
	cout<<"Check file1.txt and its contents!"<<endl;
	openfile.close();
	return 0;
}
