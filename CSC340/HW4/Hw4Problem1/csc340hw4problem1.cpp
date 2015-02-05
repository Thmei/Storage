/*
Thomas X Mei
911647469	
CSC 340
Hui Yang
Homework 4 Problem 1
*/
#include <iostream>
#include <stdlib.h>
#include "poly.h"

using namespace std;


int main()
{


int choice;
    //Abstract Data Type varibales for 3 polynomials
    //First two for input and last one for output
	polynomial P1, P2, P3;
    //cout <<  "Instruction: \nExample:\nP(x)=5x^3+3x^1\nEnter the Polynomial like\nP(x)=5x^3+0x^2+3x^1+0x^0\n" ;
    cout << "Enter Polynomial 1: " << endl;
    P1.get_data(); //accessing get_data(); function specifically for P1
    cout << "Enter Polynomial 2: " << endl;
    P2.get_data();
	//Prompts user for choice of calculation using switch( better version of multiple if's and else if's
    while (1) {
        cout << "\nNumber corresponds to function" << endl;
        cout << "1: Addition\n2: Substraction\n3: Multiplication\n4: Division:\n0: Exit" << endl;
        cout << "Enter your choice:";
        cin >> choice;
        switch (choice) {
            case 1:
                cout << "\n--------------- Addition ---------------\n";
                cout << "Polynomial1:";
                P1.display(P1.coeff, P1.degree);
                cout << "Polynomial2:";
                P2.display(P2.coeff, P2.degree);
                P3.addition(P1, P2);
                cout << "----------------------------------------\n";
                break;
            case 2:

                cout << "\n------------- Substraction -------------\n";
                cout << "Polynomial1:";
                P1.display(P1.coeff, P1.degree);
                cout << "Polynomial2:";
                P2.display(P2.coeff, P2.degree);
                P3.substraction(P1, P2);
                cout << "----------------------------------------\n";
                break;
            case 3:
                cout << "\n----------- Multiplication -------------\n";
                cout << "Polynomial1:";
                P1.display(P1.coeff, P1.degree);
                cout << "Polynomial2:";
                P2.display(P2.coeff, P2.degree);
                P3.multiplication(P1, P2);
                cout << "----------------------------------------\n" ;
                break;
        	case 4:
                cout << "\n----------- Division -------------\n";
                cout << "Polynomial1:";
                P1.display(P1.coeff, P1.degree);
                cout << "Polynomial2:";
                P2.display(P2.coeff, P2.degree);
                P3.division(P1, P2);
                cout << "----------------------------------------\n" ;
                break;
            case 0: //If user selects 0, program ends.
                cout << "Program Terminated by user" << endl;
                exit(0);
        }
    }
    return 0;
}





