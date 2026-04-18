.data
msg_name: .asciz "ENter your name:"
msg_hometown: .asciz "eNTER YOUR HOMEWOWN:"
msg_name2:  .asciz "You said your name is :"
msg_hometown2:  .asciz "You said your hometown is: "
name:  .space 100
hometown: .space 100

.text
.globl main
main:

la a0 ,msg_name
li a7, 4
ecall

la a0 ,name
li a1, 100
li a7, 8
ecall

la a0,msg_hometown
li a7, 4
ecall


la a0,hometown
li a1, 100
li a7, 8
ecall

 
 la a0, msg_name2
 li a7 ,4
 ecall
 
  la a0 ,name
  li a7, 4
  ecall
  
  la a0,msg_hometown2
  li a7,4
  ecall
  
  la a0,hometown
  li a7,4
  ecall
  
  
  li a7,10
  ecall
