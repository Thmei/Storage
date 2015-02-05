#include "polynomial.h"
#include <iostream>

using namespace std;

polynomial::polynomial()
{
	power = 5;
	
	
}

polynomial::~polynomial()
{
}

void polynomial::setPower(int pow)
{
	power = pow;
}

int polynomial::getPower()
{
	return power;
} 
