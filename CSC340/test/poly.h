#include <iostream>
using namespace std;
#ifndef POLY101
#define POLY101
class Poly 
{
 [B]private:[/B]
  int order;
  double *a;   // Coefficient vector -- a[0], a[1], a[2], ..., a[order] 
               // to represent a[0] + a[1]*x + a[2]*x^2 + ...
  
public:
  Poly(int = 0);       // Default constructor
  Poly(const Poly &p);  // Copy constructor
  ~Poly();             // Destructor (must free memory)
	
  // Function to change polynomial size/order (dynamic memory allocation)
  void Resize(int);     // Resize polynomial based on new order value
  // Math operators
  Poly operator=(const Poly &p);
  Poly operator+(const Poly &p);
  Poly operator-(const Poly &p);
  Poly operator*(const Poly &p);
  double Evaluate(double x);  // Compute and return the polynomial value at x
  // Support functions
  void SetCoeff(int o, double x);  // Set coefficient of order o to value x
  friend istream &operator>>(istream &is, Poly &p);
  friend ostream &operator<<(ostream &os, Poly &p);
  
  // Note:  The Divide() function was added for convenience.  It can be used
  // in both the / and % functions to minimize total amount of code.
  Poly operator/(const Poly &);  // Returns quotient from polynomial division
  Poly operator%(const Poly &);  // Returns remainder from polynomial division
  void Divide(const Poly &d, Poly &q, Poly &r); // d=divisor; q=quotient; r=remainder
};
#endif
