import numpy as np 
import matplotlib.pyplot as plt

if __name__ == "__main__":
    S1 = float(sys.argv[1])
    S2 = float(sys.argv[2])
    S3 = float(sys.argv[3])
    S4 = float(sys.argv[4])
    U1 = float(sys.argv[5])
    U2 = float(sys.argv[6])
    U3 = float(sys.argv[7])
    U4 = float(sys.argv[8])
    P1 = float(sys.argv[9])
    P2 = float(sys.argv[10])
    P3 = float(sys.argv[11])
    P4 = float(sys.argv[12])
    Ru1 = float(sys.argv[13])
    Ru2 = float(sys.argv[14])
    Ru3 = float(sys.argv[15])
    Ru4 = float(sys.argv[16])
    Rp1 = float(sys.argv[17])
    Rp2 = float(sys.argv[18])
    Rp3 = float(sys.argv[19])
    Rp4 = float(sys.argv[20])
    R = float(sys.argv[21])
    pi = float(sys.argv[22])
    mu = float(sys.argv[23])
    # indiquer le nombre de test en nombr de test 
    test11 = float(sys.argv[24]) 
    test12 = float(sys.argv[25])
    test21 = float(sys.argv[26]) 
    test22 = float(sys.argv[27])
    influence_1_2 =float(sys.argv[28]) 
    influence_1_3 =float(sys.argv[29])
    influence_1_4 =float(sys.argv[30])
    influence_2_3 =float(sys.argv[31])
    influence_2_4 =float(sys.argv[32])
    influence_3_4 =float(sys.argv[33])
    vecteur_condition_initiale = np.array([S1,U1,Ru1,Rp1,P1,S2,U2,Ru2,Rp2,P2,S3,U3,Ru3,Rp3,P3,S4,U4,Ru4,Rp4,P4])
    
    # Set up des variables : 
    pas = 0.001
    DD = (1/mu) * / pas
    beta = (R/DD)/ NN
    alpha = 2
    psi = 1/2


    def SURP_4(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,pas) :
        S1,U1,P1,RU1,RP1,S2,U2,P2,RU2,RP2,S3,U3,P3,RU3,RP3,S4,U4,P4,RU4,RP4 = data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15],data[16],data[17],data[18],data[19]
        condition =0.00001
    #calcul des valeurs utiles et nécessaires 

        nmbr_test_alpha1 = nmbr_test1 * pas**(alpha-1/alpha)
        nmbr_test_alpha2 = nmbr_test2 * pas**(alpha-1/alpha)
        nmbr_test_alpha3 = nmbr_test3 * pas**(alpha-1/alpha)
        nmbr_test_alpha4 = nmbr_test4 * pas**(alpha-1/alpha)

    
        inf_inter_regionale1 = beta * (influence_1_2 * U2 + influence_1_3 * U3 + influence_1_4 * U4 )
        inf_inter_regionale2 = beta * (influence_1_2 * U1 + influence_2_3 * U3 + influence_2_4 * U4 )
        inf_inter_regionale3 = beta * (influence_1_3 * U1 + influence_2_3 * U2 + influence_3_4 * U4 )
        inf_inter_regionale4 = beta * (influence_1_4 * U1 + influence_2_4 * U2 + influence_3_4 * U3 )

    # Système 1 

        if (U1<0.01) and (inf_inter_regionale1<condition) :
            dS1 = 0
            dU1 = 0
            dP1 = 0
            dR_u1 = 0
            dR_p1 =0
        else :
            dS1 = - beta * S1 * (U1 + ((1-pi)*P1))
            inf_inter_regionale1 = beta * (influence_1_2 * U2 + influence_1_3 * U3 + influence_1_4 * U4 )
            dU1 = - dS1 - (U1/DD) - (nmbr_test_alpha1**alpha) * ((U1/(U1+S1+RU1))**psi) + inf_inter_regionale1
            dP1 = (nmbr_test_alpha1**alpha) * ((U1/(U1+S1+RU1))**psi) - P1 / DD
            dR_u1 = U1 / DD
            dR_p1 = P1 / DD
        if ((nmbr_test_alpha1**alpha) * ((U1/(U1+S1+RU1))**(psi))> nmbr_test1) :
            dP1 = nmbr_test1 - P1/DD
            dU1 = -dS1-U1/DD + nmbr_test1

    # Système 2
        if (U2<0.01) and (inf_inter_regionale2<condition) :
            dS2 = 0
            dU2 = 0
            dP2 = 0
            dR_u2 = 0
            dR_p2 =0
        else :
            dS2 = - beta * S2 * (U2 + ((1-pi)*P2))
            inf_inter_regionale2 = beta * (influence_1_2 * U1 + influence_2_3 * U3 + influence_2_4 * U4 )
            dU2 = - dS2 - (U2/DD) - (nmbr_test_alpha2**alpha) * ((U2/(U2+S2+RU2))**psi) + inf_inter_regionale2
            dP2 = (nmbr_test_alpha2**alpha) * ((U2/(U2+S2+RU2))**psi) - P2 / DD
            dR_u2 = U2 / DD
            dR_p2 = P2 / DD
        if ((nmbr_test_alpha2**alpha) * ((U2/(U2+S2+RU2))**(psi))> nmbr_test2) :
            dP2 = nmbr_test2 - P2/DD
            dU2 = -dS2-U2/DD + nmbr_test2


    # Système 3
        if (U3<0.01) and (inf_inter_regionale3<condition) :
            dS3 = 0
            dU3 = 0
            dP3 = 0
            dR_u3 = 0
            dR_p3 =0
        else :
            dS3 = - beta * S3 * (U3 + ((1-pi)*P3))
            inf_inter_regionale3 = beta * (influence_1_3 * U1 + influence_2_3 * U2 + influence_3_4 * U4 )
            dU3 = - dS3 - (U3/DD) - (nmbr_test_alpha3**alpha) * ((U3/(U3+S3+RU3))**psi) +  inf_inter_regionale3
            dP3 = (nmbr_test_alpha3**alpha) * ((U3/(U3+S3+RU3))**psi) - P3 / DD
            dR_u3 = U3 / DD
            dR_p3 = P3 / DD
        if ((nmbr_test_alpha3**alpha) * ((U3/(U3+S3+RU3))**(psi))> nmbr_test3) :
            dP3 = nmbr_test3- P3/DD
            dU3 = -dS3-U3/DD + nmbr_test3
            
    # Système 4
        if (U4<0.01) and (inf_inter_regionale4<condition) :
            dS4 = 0
            dU4 = 0
            dP4 = 0
            dR_u4 = 0
            dR_p4 =0
        else :
            dS4 = - beta * S4 * (U4 + ((1-pi)*P4))
            inf_inter_regionale4 = beta * (influence_1_4 * U1 + influence_2_4 * U2 + influence_3_4 * U3 )
            dU4 = - dS4 - (U4/DD) - (nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**psi) + inf_inter_regionale4
            dP4 = (nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**psi) - P4 / DD
            dR_u4 = U4 / DD
            dR_p4 = P4 / DD
        if ((nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**(psi))> nmbr_test4) :
            dP4 = nmbr_test4- P4/DD
            dU4 = -dS4-U4/DD + nmbr_test4

        return np.array([dS1,dU1,dP1,dR_u1,dR_p1,dS2,dU2,dP2,dR_u2,dR_p2,dS3,dU3,dP3,dR_u3,dR_p3,dS4,dU4,dP4,dR_u4,dR_p4])

    def demain(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,pas) :
        for i in range (1/pas) :
            data = data + SURP_4(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,pas)
        return data

    liste = demain(vecteur_condition_initiale,test1,test2,test3,test4,pas)
    # write in data.txt
    message =''
    for element in liste : 
        message = message + str(element) + " "
    f = open('data.txt','w') 
    f.write(message)