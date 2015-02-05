#include "myException.h"

double getAvgSalary1(double total_sal, int num_people)
{
    return total_sal/num_people;
}

double getAvgSalary2(double total_sal, int num_people) throw(myException_Negative_Number, myException_Zero_Division)
{
      myException_Negative_Number e_neg;
      myException_Zero_Division e_zero;
      
      //throw 3;
      
      if (num_people < 0)
          throw e_neg;
          
      if (num_people==0)
          throw e_zero;
          
      return total_sal/num_people;
}
