/*
*******************************************************************************
*   Copyright (C) 2004-2011, International Business Machines
*   Corporation and others.  All Rights Reserved.
*******************************************************************************
*
*   file name:  udeprctd.h
*   encoding:   US-ASCII
*   tab size:   8 (not used)
*   indentation:4
*
*   Created by: genheaders.pl, a perl script written by Ram Viswanadha
*
*  Contains data for commenting out APIs.
*  Gets included by umachine.h
*
*  THIS FILE IS MACHINE-GENERATED, DON'T PLAY WITH IT IF YOU DON'T KNOW WHAT
*  YOU ARE DOING, OTHERWISE VERY BAD THINGS WILL HAPPEN!
*/

#ifndef UDEPRCTD_H
#define UDEPRCTD_H

#ifdef U_HIDE_DEPRECATED_API

#    if U_DISABLE_RENAMING
#        define ucol_getContractions ucol_getContractions_DEPRECATED_API_DO_NOT_USE
#        define ucol_getLocale ucol_getLocale_DEPRECATED_API_DO_NOT_USE
#        define ures_countArrayItems ures_countArrayItems_DEPRECATED_API_DO_NOT_USE
#        define ures_getLocale ures_getLocale_DEPRECATED_API_DO_NOT_USE
#        define ures_getVersionNumber ures_getVersionNumber_DEPRECATED_API_DO_NOT_USE
#        define utrans_getAvailableID utrans_getAvailableID_DEPRECATED_API_DO_NOT_USE
#        define utrans_getID utrans_getID_DEPRECATED_API_DO_NOT_USE
#        define utrans_unregister utrans_unregister_DEPRECATED_API_DO_NOT_USE
#    else
#        define ucol_getContractions_48 ucol_getContractions_DEPRECATED_API_DO_NOT_USE
#        define ucol_getLocale_48 ucol_getLocale_DEPRECATED_API_DO_NOT_USE
#        define ures_countArrayItems_48 ures_countArrayItems_DEPRECATED_API_DO_NOT_USE
#        define ures_getLocale_48 ures_getLocale_DEPRECATED_API_DO_NOT_USE
#        define ures_getVersionNumber_48 ures_getVersionNumber_DEPRECATED_API_DO_NOT_USE
#        define utrans_getAvailableID_48 utrans_getAvailableID_DEPRECATED_API_DO_NOT_USE
#        define utrans_getID_48 utrans_getID_DEPRECATED_API_DO_NOT_USE
#        define utrans_unregister_48 utrans_unregister_DEPRECATED_API_DO_NOT_USE
#    endif /* U_DISABLE_RENAMING */

#endif /* U_HIDE_DEPRECATED_API */
#endif /* UDEPRCTD_H */

