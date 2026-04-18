.text
.globl main
main:
    li t0, 15        # first number
    li t1, 9         # second number

    xor t2, t0, t1   # t2 = t0 XOR t1
    
    # 5 -> 1111
    # 10 -> 1001
    # -----------
    # XOR-> 0110 -> 6

    mv a0, t2        # print result
    li a7, 1
    ecall

    li a7, 10
    ecall
