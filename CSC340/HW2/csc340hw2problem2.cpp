/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 2 Problem 2
*/

#include <iostream>
#include <fstream>
#include <string>

using namespace std;

ifstream input;
ifstream input2;
ifstream input3;

int merge();
int main(){
	
//prompts use to enter three file names

cout << "Please enter first file name: ";
	
char filename[50];
//ifstream input;
cin.getline(filename,50);
input.open(filename);

cout << "Please enter second file name: ";

char filename2[50];
//ifstream input2;
cin.getline(filename2,50);
input2.open(filename2);

cout << "Please enter final file name: ";

char filename3[50];
//ifstream input3;
cin.getline(filename3,50);
input3.open(filename3);

merge();

return 0;

}

//function to put the values inside the three text files into a fourth file keepign the same order
int merge(){


ofstream myFile;
myFile.open("testfile.txt");

int c1;
int c2;
int c3;

input >> c1;
input2 >> c2;
input3 >> c3;

while(!input.eof()){
	myFile << c1 << "\n";
	input >> c1;
}
while(!input2.eof()){

	myFile << c2 << "\n";
	input2 >> c2;
}
while(!input3.eof()){

	myFile << c3 << "\n";
	input3 >> c3;
	
}
//lets the user know that the name of the file that was created 
cout << "The files have been merged into a file named testfile.txt ";
	
input.close();
	
return 0;
}


