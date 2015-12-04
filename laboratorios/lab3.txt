Diagrama 1
-------------------------------------------------------

Departamento(\bold underline\designacao\, localizacao)

Empregado(\nbi\,nome,dep)
  dep: FK Departamento(designacao)
  NOT NULL(dep)

Tarefeiro(descricao,quantia,\nbi\)
  nbi: FK Empregado(nbi)

Efectivo(especialidade,\nbi\)
  nbi: FK Empregado(nbi)

Contrato(Salario,\Categoria\,\nbi\)
  nbi: FK Efectivo(nbi)

RI#1: Quando "Efectivo" é eliminado o respectivo "Contrato" tambem o é
RI#2: Quando "Empregado" é eliminado o respetivo "Tarefeiro" ou "Efectivo"


-------------------------------------------------------
Diagrama 2
-------------------------------------------------------
Person(\driver-id\,address,name)

Car(\license\,model,year)

Person-Car-Ownship( \\(\driver-id\,\license\) )
  driver-id: FK person(driver-id)

Accident(\report-number\), location, date)

Accident_Relation( \(\driver-id\,\license\,\r_number\) ,damage_amount)
  license: FK person(license)
  driver-id: FK person(driver-id)
  license: FK car(license)
  r_number: FK accident(report-number)


-------------------------------------------------------
Diagrama 3
-------------------------------------------------------
student(\sid\,name,progam)

instructor(\iid\,name,dept,title)

course(\courseno\,title,syllabus,credits)

maincorse_requires( \(\maincourse\,\prerequisite\))
  prerequisite: FK course(courseno)
  maincourse: FK course(courseno)

course_offerings( \(\semester\,\year\,\courseno\), time,room)
  courseno: FK course(corseno)

enrols( \(\semester\,\year\,\sid\,\courseno),grade)
  semester: FK course_offerings(semester)
  year: FK course_offerings(year)
  courseno: FK course_offerings(courseno)
  sid: FK student(sid)

teaches( \(\semester\,\year\,\iid\,\courseno),grade)
  semester: FK course_offerings(semester)
  year: FK course_offerings(year)
  courseno: FK course_offerings(courseno)
  iid: FK instructor(iid)

-------------------------------------------------------
Diagrama 4
-------------------------------------------------------
Client(\ID\,name,Address,phone)

Employee(\Number\,name)

Mechanic(\Number\)
  Number FK Employee(\Number\)

Salesman(\Number\)
  Number FK Employee(\Number\)

Car(\license\,manufacturer,model,year)

SELLS(\Number\,\ID\,\License\,Date,Value,Comission)
  Number: FK Salesman(Number)
  ID:     FK Client(ID)
  License:FK Car(License)
