.data
msg_name:     .asciz "Your full name: "
msg_town:     .asciz "Your hometown: "
msg_name2:     .asciz "You said that your full name is: "
msg_town2:     .asciz "You said that your hometown is: "
name:         .space 100
hometown:     .space 100

.text
.globl main
main:
    # Ask for full name
    la a0, msg_name
    li a7, 4 # sys call is print_string
    ecall

    # Read full name
    la a0, name
    li a1, 100
    li a7, 8 # syscall for reading string
    ecall

    # Ask for hometown
    la a0, msg_town
    li a7, 4 #syscall fo print_string
    ecall

    # Read hometown
    la a0, hometown
    li a1, 100
    li a7, 8 # syscall for read string
    ecall

    # Print full name
    la a0, msg_name2
    li a7, 4
    ecall

    la a0, name
    li a7, 4
    ecall

    # Print hometown
    la a0, msg_town2
    li a7, 4
    ecall

    la a0, hometown
    li a7, 4
    ecall

    # Exit
    li a7, 10
    ecall
