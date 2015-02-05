#include "poly.h"
#include<iostream>
#include<stdlib.h>
using namespace std;

int polynomial::display(int *coeff, int degree) {
    int i, j;
    for (i = degree; i >= 0; i--) {
        cout << coeff[i] << "x^" << i;
        if ((i - 1) != -1)
            cout << "+";
    }
    cout << "\n";
    return 0;
}

int polynomial::get_data() {
    int i;
    cout << "Enter Degree Of Polynomial:";
    cin >> degree;
    coeff = new int[degree + 1];
    for (i = degree; i >= 0; i--) {
        cout << "Enter coefficient of x^" << i << ":";
        cin >> coeff[i];
    }

    return 0;
}

void polynomial::addition(polynomial P1, polynomial P2) {
    int max, i;
    max = (P1.degree > P2.degree) ? P1.degree : P2.degree;
    int *add = new int[max + 1];
    if (P1.degree == P2.degree) {
        for (i = P1.degree; i >= 0; i--)
            add[i] = P1.coeff[i] + P2.coeff[i];
    }

    if (P1.degree > P2.degree) {
        for (i = P1.degree; i > P2.degree; i--)
            add[i] = P1.coeff[i];
        for (i = P2.degree; i >= 0; i--)
            add[i] = P1.coeff[i] + P2.coeff[i];
    }

    if (P1.degree < P2.degree) {
        for (i = P2.degree; i > P1.degree; i--)
            add[i] = P2.coeff[i];
        for (i = P1.degree; i >= 0; i--)
            add[i] = P1.coeff[i] + P2.coeff[i];
    }
    cout << "\nAddition:";
    display(add, max);
    cout << "\n";
}

void polynomial::substraction(polynomial P1, polynomial P2) {
    int max, i;
    max = (P1.degree > P2.degree) ? P1.degree : P2.degree;
    int *sub = new int[max + 1];
    if (P1.degree == P2.degree) {
        for (i = P1.degree; i >= 0; i--)
            sub[i] = P1.coeff[i] - P2.coeff[i];
    }

    if (P1.degree > P2.degree) {
        for (i = P1.degree; i > P2.degree; i--)
            sub[i] = P1.coeff[i];
        for (i = P2.degree; i >= 0; i--)
            sub[i] = P1.coeff[i] - P2.coeff[i];
    }

    if (P1.degree < P2.degree) {
        for (i = P2.degree; i > P1.degree; i--)
            sub[i] = -P2.coeff[i];
        for (i = P1.degree; i >= 0; i--)
            sub[i] = P1.coeff[i] - P2.coeff[i];
    }
    cout << "\nSubstraction:";
    display(sub, max);
    cout << "\n";
}

void polynomial::multiplication(polynomial P1, polynomial P2) {
    int i, j, max;
   max = (P1.degree > P2.degree) ? P1.degree : P2.degree;
    int *mul = new int[max + 1];

    if (P1.degree == P2.degree) {
        for (i = P1.degree; i >= 0; i--)
            mul[i] = P1.coeff[i] * P2.coeff[i];
    }

    if (P1.degree > P2.degree) {
        for (i = P1.degree; i > P2.degree; i--)
            mul[i] = P1.coeff[i];
        for (i = P2.degree; i >= 0; i--)
            mul[i] = P1.coeff[i] * P2.coeff[i];
    }

    if (P1.degree < P2.degree) {
        for (i = P2.degree; i > P1.degree; i--)
            mul[i] = P2.coeff[i];
        for (i = P1.degree; i >= 0; i--)
            mul[i] = P1.coeff[i] * P2.coeff[i];
    }
    cout << "\nMultiplication:";
    display(mul, max);
}
void polynomial::division(polynomial P1, polynomial P2) {
    int i, j, max;
   max = (P1.degree > P2.degree) ? P1.degree : P2.degree;
    int *div = new int[max + 1];

    if (P1.degree == P2.degree) {
        for (i = P1.degree; i >= 0; i--)
            div[i] = P1.coeff[i] / P2.coeff[i];
    }

    if (P1.degree > P2.degree) {
        for (i = P1.degree; i > P2.degree; i--)
            div[i] = P1.coeff[i];
        for (i = P2.degree; i >= 0; i--)
            div[i] = P1.coeff[i] / P2.coeff[i];
    }

    if (P1.degree < P2.degree) {
        for (i = P2.degree; i > P1.degree; i--)
            div[i] = P2.coeff[i];
        for (i = P1.degree; i >= 0; i--)
            div[i] = P1.coeff[i] / P2.coeff[i];
    }
    cout << "\nDivision:";
    display(div, max);
}


