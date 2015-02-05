#ifndef _MY_EXCEPTION_H
#define _MY_EXCEPTION_H

#include <stdexcept>
#include <iostream>
#include <string>

using namespace std;

class myException_Large_Value: public exception
{
      public:
              virtual const char* what() const throw()
              {
                return "Caught a large_value exception! Need to be <9000000";
              }

};

class myException_Zero_Division: public exception
{
      public: 
              virtual const char* what() const throw()
              {
                return "Caught a zero-division exception!";
              }

};

class myException_Negative_Number: public exception
{
      public: 
              virtual const char* what() const throw()
              {
                return "Caught a negative-number exception!";
              }

};
/**insert comments here
*/
double getAvgSalary1(double total_sal, int num_people);

/**insert comments here
*/
double getAvgSalary2(double total_sal, int num_people) throw(myException_Negative_Number, myException_Zero_Division);

#endif
