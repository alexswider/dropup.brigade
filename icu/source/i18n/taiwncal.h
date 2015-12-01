/*
 ********************************************************************************
 * Copyright (C) 2003-2007, International Business Machines Corporation
 * and others. All Rights Reserved.
 ********************************************************************************
 *
 * File BUDDHCAL.H
 *
 * Modification History:
 *
 *   Date        Name        Description
 *   05/13/2003  srl          copied from gregocal.h
 *   06/29/2007  srl          copied from buddhcal.h
 ********************************************************************************
 */

#ifndef TAIWNCAL_H
#define TAIWNCAL_H

#include "unicode/utypes.h"

#if !UCONFIG_NO_FORMATTING

#include "unicode/calendar.h"
#include "unicode/gregocal.h"

U_NAMESPACE_BEGIN

/**
 * Concrete class which provides the Taiwan calendar.
 * <P>
 * <code>TaiwanCalendar</code> is a subclass of <code>GregorianCalendar</code>
 * that numbers years since 1912
 * <p>
 * The Taiwan calendar is identical to the Gregorian calendar in all respects
 * except for the year and era.  Years are numbered since 1912 AD (Gregorian),
 * so that 1912 AD (Gregorian) is equivalent to 1 MINGUO (Minguo Era) and 1998 AD is 87 MINGUO.
 * <p>
 * The Taiwan Calendar has two eras: <code>BEFORE_MINGUO</code> and <code>MINGUO</code>.
 * <p>
 * @internal
 */
class TaiwanCalendar : public GregorianCalendar {
public:

    /**
     * Useful constants for TaiwanCalendar.  Only one Era.
     * @internal
     */
    enum EEras {
       BEFORE_MINGUO = 0,
       MINGUO  = 1
    };

    /**
     * Constructs a TaiwanCalendar based on the current time in the default time zone
     * with the given locale.
     *
     * @param aLocale  The given locale.
     * @param success  Indicates the status of TaiwanCalendar object construction.
     *                 Returns U_ZERO_ERROR if constructed successfully.
     * @internal
     */
    TaiwanCalendar(const Locale& aLocale, UErrorCode& success);


    /**
     * Destructor
     * @internal
     */
    virtual ~TaiwanCalendar();

    /**
     * Copy constructor
     * @param source    the object to be copied.
     * @internal
     */
    TaiwanCalendar(const TaiwanCalendar& source);

    /**
     * Default assignment operator
     * @param right    the object to be copied.
     * @internal
     */
    TaiwanCalendar& operator=(const TaiwanCalendar& right);

    /**
     * Create and return a polymorphic copy of this calendar.
     * @return    return a polymorphic copy of this calendar.
     * @internal
     */
    virtual Calendar* clone(void) const;

public:
    /**
     * Override Calendar Returns a unique class ID POLYMORPHICALLY. Pure virtual
     * override. This method is to implement a simple version of RTTI, since not all C++
     * compilers support genuine RTTI. Polymorphic operator==() and clone() methods call
     * this method.
     *
     * @return   The class ID for this object. All objects of a given class have the
     *           same class ID. Objects of other classes have different class IDs.
     * @internal
     */
    virtual UClassID getDynamicClassID(void) const;

    /**
     * Return the class ID for this class. This is useful only for comparing to a return
     * value from getDynamicClassID(). For example:
     *
     *      Base* polymorphic_pointer = createPolymorphicObject();
     *      if (polymorphic_pointer->getDynamicClassID() ==
     *          Derived::getStaticClassID()) ...
     *
     * @return   The class ID for all objects of this class.
     * @internal
     */
    U_I18N_API static UClassID U_EXPORT2 getStaticClassID(void);

    /**
     * return the calendar type, "Taiwan".
     *
     * @return calendar type
     * @internal
     */
    virtual const char * getType() const;

private:
    TaiwanCalendar(); // default constructor not implemented

 protected:
     /**
     * Return the extended year defined by the current fields.  This will
     * use the UCAL_EXTENDED_YEAR field or the UCAL_YEAR and supra-year fields (such
     * as UCAL_ERA) specific to the calendar system, depending on which set of
     * fields is newer.
     * @return the extended year
     * @internal
     */
    virtual int32_t handleGetExtendedYear();
    /**
     * Subclasses may override this method to compute several fields
     * specific to each calendar system.  
     * @internal
     */
    virtual void handleComputeFields(int32_t julianDay, UErrorCode& status);
    /**
     * Subclass API for defining limits of different types.
     * @param field one of the field numbers
     * @param limitType one of <code>MINIMUM</code>, <code>GREATEST_MINIMUM</code>,
     * <code>LEAST_MAXIMUM</code>, or <code>MAXIMUM</code>
     * @internal
     */
    virtual int32_t handleGetLimit(UCalendarDateFields field, ELimitType limitType) const;

    /**
     * Returns TRUE because the Taiwan Calendar does have a default century
     * @internal
     */
    virtual UBool haveDefaultCentury() const;

    /**
     * Returns the date of the start of the default century
     * @return start of century - in milliseconds since epoch, 1970
     * @internal
     */
    virtual UDate defaultCenturyStart() const;

    /**
     * Returns the year in which the default century begins
     * @internal
     */
    virtual int32_t defaultCenturyStartYear() const;

 private: // default century stuff.
    /**
     * The system maintains a static default century start date.  This is initialized
     * the first time it is used.  Before then, it is set to SYSTEM_DEFAULT_CENTURY to
     * indicate an uninitialized state.  Once the system default century date and year
     * are set, they do not change.
     */
    static UDate         fgSystemDefaultCenturyStart;

    /**
     * See documentation for systemDefaultCenturyStart.
     */
    static int32_t          fgSystemDefaultCenturyStartYear;

    /**
     * Default value that indicates the defaultCenturyStartYear is unitialized
     */
    static const int32_t    fgSystemDefaultCenturyYear;

    /**
     * start of default century, as a date
     */
    static const UDate        fgSystemDefaultCentury;

    /**
     * Returns the beginning date of the 100-year window that dates 
     * with 2-digit years are considered to fall within.
     */
    UDate         internalGetDefaultCenturyStart(void) const;

    /**
     * Returns the first year of the 100-year window that dates with 
     * 2-digit years are considered to fall within.
     */
    int32_t          internalGetDefaultCenturyStartYear(void) const;

    /**
     * Initializes the 100-year window that dates with 2-digit years
     * are considered to fall within so that its start date is 80 years
     * before the current time.
     */
    static void  initializeSystemDefaultCentury(void);
};

U_NAMESPACE_END

#endif /* #if !UCONFIG_NO_FORMATTING */

#endif // _TAIWNCAL
//eof

