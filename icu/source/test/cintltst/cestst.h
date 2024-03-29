/********************************************************************
 * COPYRIGHT: 
 * Copyright (c) 1997-2001, International Business Machines Corporation and
 * others. All Rights Reserved.
 ********************************************************************/
/********************************************************************************
*
* File CESTST.H
*
* Modification History:
*        Name                     Description            
*     Madhu Katragadda            Converted to C
*********************************************************************************/
/**
 * CollationSpanishTest is a third level test class.  This tests the locale
 * specific primary, secondary and tertiary rules.  For example, the ignorable
 * character '-' in string "black-bird".  The en_US locale uses the default
 * collation rules as its sorting sequence.
 */

#ifndef _CESCOLLTST
#define _CESCOLLTST

#include "unicode/utypes.h"

#if !UCONFIG_NO_COLLATION

#include "cintltst.h"


#define MAX_TOKEN_LEN 16
   
  
      /* perform test with strength SECONDARY */
 static   void TestPrimary(void);

    /* perform test with strength TERTIARY */
 static    void TestTertiary(void);


#endif /* #if !UCONFIG_NO_COLLATION */
    

#endif
