#################################################################################
## Makefile.in for ICU - tools/genrb                                            #
## Copyright (c) 1999-2009, International Business Machines Corporation and     #
## others. All Rights Reserved.                                                 #
#################################################################################

## Source directory information
srcdir = .
top_srcdir = ../..

top_builddir = ../..

include $(top_builddir)/icudefs.mk

## Build directory information
subdir = tools/genrb

TARGET_STUB_NAME = genrb
DERB_STUB_NAME = derb

SECTION = 1

MAN_FILES = $(TARGET_STUB_NAME).$(SECTION) $(DERB_STUB_NAME).$(SECTION)


## Extra files to remove for 'make clean'
CLEANFILES = *~ $(MAN_FILES) $(DEPS) $(DERB_DEPS)

## Target information
TARGET = $(BINDIR)/$(TARGET_STUB_NAME)$(EXEEXT)
DERB = $(BINDIR)/$(DERB_STUB_NAME)$(EXEEXT)

ifneq ($(top_builddir),$(top_srcdir))
CPPFLAGS += -I$(top_builddir)/common
endif
CPPFLAGS += -I$(top_srcdir)/common -I$(top_srcdir)/i18n -I$(srcdir)/../toolutil
LIBS = $(LIBICUTOOLUTIL) $(LIBICUI18N) $(LIBICUUC) $(DEFAULT_LIBS) $(LIB_M)

OBJECTS = errmsg.o genrb.o parse.o read.o reslist.o ustr.o rbutil.o \
wrtjava.o rle.o wrtxml.o prscmnts.o
DERB_OBJ = derb.o

DEPS = $(OBJECTS:.o=.d)
DERB_DEPS = $(DERB_OBJ:.o=.d)

-include Makefile.local

## List of phony targets
.PHONY : all all-local install install-local clean clean-local	\
distclean distclean-local dist dist-local check check-local install-man

## Clear suffix list
.SUFFIXES :

## List of standard targets
all: all-local
install: install-local
clean: clean-local
distclean : distclean-local
dist: dist-local
check: all check-local

all-local: $(TARGET) $(DERB) $(MAN_FILES) 

install-local: all-local install-man
	$(MKINSTALLDIRS) $(DESTDIR)$(bindir)
	$(INSTALL) $(TARGET) $(DESTDIR)$(bindir)
	$(INSTALL) $(DERB) $(DESTDIR)$(bindir)

install-man: $(MAN_FILES)
	$(MKINSTALLDIRS) $(DESTDIR)$(mandir)/man$(SECTION)
	$(INSTALL_DATA) $? $(DESTDIR)$(mandir)/man$(SECTION)

dist-local:

clean-local:
	test -z "$(CLEANFILES)" || $(RMV) $(CLEANFILES)
	$(RMV) $(TARGET) $(DERB) $(OBJECTS) $(DERB_OBJ)

distclean-local: clean-local
	$(RMV) Makefile

check-local: all-local

Makefile: $(srcdir)/Makefile.in  $(top_builddir)/config.status
	cd $(top_builddir) \
	 && CONFIG_FILES=$(subdir)/$@ CONFIG_HEADERS= $(SHELL) ./config.status

$(TARGET) : $(OBJECTS)
	$(LINK.cc) $(OUTOPT)$@ $^ $(LIBS) 
	$(POST_BUILD_STEP)

$(DERB) : $(DERB_OBJ)
	$(LINK.cc) $(OUTOPT)$@ $^ $(LIBS)
	$(POST_BUILD_STEP)

# This line is needed to serialize builds when the gmake -j option is used.
$(TARGET_STUB_NAME).$(SECTION): $(DERB_STUB_NAME).$(SECTION)

%.$(SECTION): $(srcdir)/%.$(SECTION).in
	cd $(top_builddir) \
	 && CONFIG_FILES=$(subdir)/$@ CONFIG_HEADERS= $(SHELL) ./config.status


ifeq (,$(MAKECMDGOALS))
-include $(DEPS)
-include $(DERB_DEPS)
else
ifneq ($(patsubst %clean,,$(MAKECMDGOALS)),)
-include $(DEPS)
endif
endif
