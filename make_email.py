import numpy as np, os, sys, datetime, calendar, time

### first read the template
template_file_name = 'Unimelb_seminar_template.html'
template_file = open(template_file_name, 'r')
template = template_file.readlines()

### create the output directory
op_dir = 'talks'
if not os.path.exists(op_dir): os.system('mkdir %s' %(op_dir))

### read the database and create output files
rec_file_name = 'astro_colloquium.txt'
records = np.recfromtxt(rec_file_name, delimiter ='%%%', autostrip=1, encoding='UTF-8')

### keynames
### process records and create outputfiles now
all_speakers = []
for qq, rec in enumerate(records[-2:]):
    speakername = rec[3].replace(' ', '_')
    Nsamespeaker = 2
    while speakername in all_speakers:
        speakername = '%s_%d'%(rec[3].replace(' ', '_'), Nsamespeaker)
        Nsamespeaker += 1
    all_speakers.append(speakername)
    
    op_page_name = '%s/%s.html'%(op_dir, speakername)
    #if os.path.exists(op_page_name): 
    #    print("something is wrong... %s"%op_page_name)

    #now create page
    dateval=str(rec[0])
    YYYY,MM,DD=int(dateval[0:4]),int(dateval[4:6]),int(dateval[6:8])
    format_time_str=datetime.datetime(YYYY,MM,DD)
    format_time=calendar.timegm(format_time_str.timetuple())
    yearshouldgohere=YYYY
    dateshouldgohere=time.strftime('%d %b', time.gmtime(format_time))
    dayshouldgohere=time.strftime('%A', time.gmtime(format_time))

    if rec[6] == 'TBA': rec[6] = 'TBA<br><br><br><br><br><br><br><br>'#; print rec
    if rec[5] == 'TBA': rec[5] = 'Title: TBA'
    currdic = {'dateshouldgohere': rec[0], 'timeshouldgohere': rec[1], 'locationshouldgohere': rec[2], 'nameshouldgohere': rec[3], 'affliationshouldgohere': rec[4], 'titleshouldgohere': rec[5], 'abstractshouldgohere': rec[6], 'extrashouldgohere': rec[7], 'positionshouldgohere': rec[8], 'yearshouldgohere': yearshouldgohere, 'dateshouldgohere':dateshouldgohere, 'dayshouldgohere':dayshouldgohere, 'speakerimageshouldgohere':rec[9], 'talkimageshouldgohere': rec[10], 'speakeremailshouldgohere': rec[11], 'slidelinkshouldgohere': rec[12]}
    """
    op_page_name_split = op_page_name.split('/')
    if len( op_page_name_split ) > 2:
        op_page_name_split[1] = '_'.join(op_page_name_split[1:])
        op_page_name = '/'.join(op_page_name_split[0:2])
    """
    opfile = open(op_page_name, 'w')    
    for lines in template:
        opline = lines
        for keyname in currdic:
            if opline.find(keyname) > -1: 
                '''
                if keyname == 'extrashouldgohere' and currdic[keyname] <> '':
                    opline = opline.replace(keyname, '&nbsp;&nbsp;&nbsp;<b><u>Note:</u></b> ** %s **' %(str(currdic[keyname])))
                else:
                    opline = opline.replace(keyname, str(currdic[keyname]))
                '''
                if keyname == 'speakerimageshouldgohere' or keyname == 'talkimageshouldgohere':
                    if currdic[keyname] == '-':
                        opline = ''
                    else:
                        opline = opline.replace(keyname, '../images/%s' %(str(currdic[keyname])))
                elif keyname == 'slidelinkshouldgohere':
                    if currdic[keyname] == '-':
                        opline = ''
                    else:
                        opline = opline.replace(keyname, 'slides/%s' %(str(currdic[keyname])))
                else:
                    opline = opline.replace(keyname, str(currdic[keyname]))
        opline = opline.replace('\\n','<br><br>')
        opfile.writelines(opline)
    opfile.close()
    print('html file created for %s: %s' %(rec[3], op_page_name))
    
    
    if qq ==0:
        with open('email.txt', 'w') as email_file:
            email_file.write('[status pending]\n')
            email_file.write('[category Colloquium]\n')
            email_file.write('[slug %s.html]\n'%speakername)
            email_file.write('[comments off]\n')
            email_file.write("%s %s %s @ %s, %s\n"%(currdic['dayshouldgohere'], currdic['dateshouldgohere'], currdic['yearshouldgohere'], currdic['timeshouldgohere'], currdic['locationshouldgohere']))
            email_file.write('<strong>%s</strong>, <em>%s</em>\nEmail: %s\n'%(currdic['nameshouldgohere'], currdic['affliationshouldgohere'],currdic['speakeremailshouldgohere']))
            email_file.write('<section>\n<h2>Abstract</h2>\n')
            email_file.write('%s\n<\section>\n[end]'%currdic['abstractshouldgohere'])
        print('mail -s "%s"' "vuba137dile@post.wordpress.com"%currdic['titleshouldgohere'])
