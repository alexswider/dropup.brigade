## Makefile.in for ICU - tools/gentest
## Copyright (c) 1999-2008, International Business Machines Corporation and
## others. All Rights Reserved.
## Madhu Katragadda

## Source directory information
srcdir = .
top_srcdir = ../..

top_builddir = ../..

include $(top_builddir)/icudefs.mk

## Build directory information
subdir = tools/gentest

## Extra files to remove for 'make clean'
CLEANFILES = *~ $(DEPS)

## Target information
TARGET = gentest$(EXEEXT)

ifneq ($(top_builddir),$(top_srcdir))
CPPFLAGS += -I$(top_builddir)/common 
endif
CPPFLAGS += -I$(top_srcdir)/common -I$(srcdir)/../toolutil -I$(top_srcdir)/tools/ctestfw 
CPPFLAGS+= -I$(top_srcdir)/i18n
LIBS = $(LIBCTESTFW) $(LIBICUTOOLUTIL) $(LIBICUI18N) $(LIBICUUC) $(DEFAULT_LIBS) $(LIB_M)

OBJECTS = gentest.o genres32.o

DEPS = $(OBJECTS:.o=.d)

## List of phony targets
.PHONY : all all-local install install-local clean clean-local		\
distclean distclean-local dist dist-local check check-local

## Clear suffix list
.SUFFIXES :

## List of standard targets
all: all-local
install: install-local
clean: clean-local
distclean : distclean-local
dist: dist-local
check: all check-local

all-local: $(TARGET) 

install-local: all-local

dist-local:

clean-local:
	test -z "$(CLEANFILES)" || $(RMV) $(CLEANFILES)
	$(RMV) $(TARGET) $(OBJECTS)

distclean-local: clean-local
	$(RMV) Makefile

check-local: all-local

Makefile: $(srcdir)/Makefile.in  $(top_builddir)/config.status
	cd $(top_builddir) \
	 && CONFIG_FILES=$(subdir)/$@ CONFIG_HEADERS= $(SHELL) ./config.status

$(TARGET) : $(OBJECTS)
	$(LINK.cc) $(OUTOPT)$@ $^ $(LIBS) 
	$(POST_BUILD_STEP)

ifeq (,$(MAKECMDGOALS))
-include $(DEPS)
else
ifneq ($(patsubst %clean,,$(MAKECMDGOALS)),)
-include $(DEPS)
endif
endif

