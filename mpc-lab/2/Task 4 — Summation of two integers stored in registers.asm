.text
.globl main
main:
    li t0, 12        # first number
    li t1, 7         # second number

    add t2, t0, t1   # t2 = t0 + t1

    mv a0, t2        # print result
    li a7, 1
    ecall

    li a7, 10
    ecall
