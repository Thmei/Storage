#ifndef POLY_H
#define POLY_H

class polynomial {
public:
    int *coeff, degree; /* variable declaration */

    int get_data(); /*function declaration */
    int display(int *coeff, int degree);
    void addition(polynomial P1, polynomial P2);
    void substraction(polynomial P1, polynomial P2);
    void multiplication(polynomial P1, polynomial P2);
    void division(polynomial P1, polynomial P2);
};


double sum(double a, double b);
double product(double a, double b);
double subtract(double a, double b);

#endif
