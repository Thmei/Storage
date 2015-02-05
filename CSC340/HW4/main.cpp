#include <iostream>
#include <stdlib.h>
#include "poly.h"

using namespace std;


int main()
{


int choice;
    polynomial P1, P2, P3;
    
    
    P1.get_data();
    cout << "Enter Polynomial 2:" << endl;
    P2.get_data();

    while (1) {
        cout << "\n****** Menu Selection ******" << endl;
        cout << "1: Addition\n2: Substraction\n3: Multiplication\n0: Exit" << endl;
        cout << "Enter ypur choice:";
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
            case 0:
                cout << "Good Bye...!!!" << endl;
                exit(0);
        }
    }
    return 0;
}





