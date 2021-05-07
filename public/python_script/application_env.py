#!/usr/bin/env python
import environnement_exp as env
import numpy as np 
import time 
import sys 
from scipy.integrate import odeint 
import os 
import matplotlib.pyplot as plt
# Test pour voir de beaux graphes de base et cool 
"""
NN = (10**5) 
beta,pi,mu = 2.5,1,0.01
VIRUS = env.maladie(beta,pi,mu)
Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN-40,40,0,0,0)
proportion_test= 0.1 # proportionde la population testée
duree = 20 # en jours 
Lorraine.crache_un_graphe(proportion_test,duree)
"""

 
# Les test pour savoir si notre modèle est cohérent 
"""
NN = (10**5) 
R,pi,mu = 10,1,1/15
VIRUS = env.maladie(R,pi,mu)
Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN*0.95,NN*0.05,0,0,0)
proportion_test = 0.1 # proportionde la population testée
duree = 100 # en jours 
Lorraine.crache_un_graphe_continu(proportion_test,duree)
"""

#Enquêtons sur les valeurs négatives ! 
"""
NN = (10**5) 
R,pi,mu = 8,1,1/14
VIRUS = env.maladie(R,pi,mu)
Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN*0.95,NN*0.05,0,0,0)
proportion_test = 0 
duree = 50 # en jours 
for i in range (100) :
    Lorraine.evol_local_seule (proportion_test)
"""

"""
# Définition du virus identique aux deux environnement
NN = (10**5) 
R,pi,mu = 5,0,1/14
VIRUS = env.maladie(R,pi,mu)
proportion_test = 0
duree = 100 # en jours 

# Graphique avec raisonnement discret 

Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN*0.95,NN*0.05,0,0,0)
Lorraine.crache_un_graphe(proportion_test,duree)

# Graphique  avec raisonnement continu
VIRUS = env.maladie(R,pi,mu)
Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN*0.95,NN*0.05,0,0,0)
Lorraine.crache_un_graphe_continu(proportion_test,duree)
"""
#  La fonction de controllabilité est plutot ok don con va faire un petit grille search 

# Définissons les maladies que nous allons étudiés
"""
NN = 10 ** 4
grille = []
for proportion_test in [0,0.01,0.05] :
    for R in range (3,21) :
        print(R)
        for PI in np.arange(0.1,1.1,0.1) :
            for MU in np.arange (5,30,5) : 
                MU = 1/MU
                coronavirus = env.maladie(R,PI,MU)
                region = env.env_minimal("Lorraine",NN,coronavirus,0,NN*0.95,NN*0.05,0,0,0)
                grille.append(region.determiner_controllabilite (proportion_test,100))
grille = np.array(grille)
np.savetxt("grille_search.txt",grille,delimiter=";",header='R,mu,pi,proportion testée,infecté max, date, Infecté par maladie , infectée au bout de 100 jours ')
"""

"""
#Je teste le monstre de calcul avec 4 régions et je vais corriger petit à petit les milliard ed bug 
# Il faut multiplier par 4 beta car la population 4 fois plus importante il y a qqch que je ne comprends pas de ouf 
R,pi,mu = 10,1,1/15
peste = env.maladie(R,pi,mu)
matrice_influence = [[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0]]
NN1,NN2,NN3,NN4 = 10**5,10**5,10**5,10**5
S01,U01,P01,R0_U1,R0_P1 = NN1 * 0.95 ,NN1* 0.05 ,0,0,0
S02,U02,P02,R0_U2,R0_P2 = NN2 * 0.95 ,NN2* 0.05 ,0,0,0
S03,U03,P03,R0_U3,R0_P3 = NN3 * 0.95 ,NN3* 0.05 ,0,0,0
S04,U04,P04,R0_U4,R0_P4 = NN4 * 0.95 ,NN4* 0.05 ,0,0,0
# question sur le beta qui doit-être divisé par pop  totale ou locale 
monde = env.env_total(NN1,NN2,NN3,NN4,peste,matrice_influence,S01,U01,P01,R0_U1,R0_P1,S02,U02,P02,R0_U2,R0_P2,S03,U03,P03,R0_U3,R0_P3,S04,U04,P04,R0_U4,R0_P4)
monde.graphe_sur_charge(0.1,0.25,0.4,0.5)
"""
'''

NN = (10**4) 
R,pi,mu = 4,1,1/28
VIRUS = env.maladie(R,pi,mu)
proportion_test = 0.
VIRUS = env.maladie(R,pi,mu)
duree = 100
Lorraine = env.env_minimal("Lorraine",NN,VIRUS,0,NN*0.99,NN*0.01,0,0,0)
Lorraine.crache_un_graphe_continu(proportion_test,duree)
print(Lorraine.determiner_controllabilite (proportion_test,100))

'''


def fonction_horrible(s1,u1,p1,ru1,rp1,s2,u2,p2,ru2,rp2,s3,u3,p3,ru3,rp3,s4,u4,p4,ru4,rp4,R,pi,mu,matrice_influence) :
    VIRUS = env.maladie(R,pi,mu)
    en = env.env_total(100000,100000,100000,100000,VIRUS,matrice_influence,s1,u1,p1,ru1,rp1,s2,u2,p2,ru2,rp2,s3,u3,p3,ru3,rp3,s4,u4,p4,ru4,rp4)
    en.donnees_demain(test11,test12,test21,test22)
    message = str(en.S1)+" "+str(en.S2)+" "+str(en.S3)+" "+str(en.S4)+" "+str(en.U1)+" "+str(en.U2)+" "+str(en.U3)+" "+str(en.U4)+" "+str(en.P1)+" "+str(en.P2)+" "+str(en.P3)+" "+str(en.P4)+" "+str(en.R_U1)+" "+str(en.R_U2)+" "+str(en.R_U3)+" "+str(en.R_U4)+" "+str(en.R_P1)+" "+str(en.R_P2)+" "+str(en.R_P3)+" "+str(en.R_P4)
    message = "echo " + message
    os.system(message)
    return [en.S1,en.S2,en.S3,en.S4,en.U1,en.U2,en.U3,en.U4,en.P1,en.P2,en.P3,en.P4,en.R_U1,en.R_U2,en.R_U3,en.R_U4,en.R_P1,en.R_P2,en.R_P3,en.R_P4]



if __name__ == "__main__":
    s1 = float(sys.argv[1])
    s2 = float(sys.argv[2])
    s3 = float(sys.argv[3])
    s4 = float(sys.argv[4])
    u1 = float(sys.argv[5])
    u2 = float(sys.argv[6])
    u3 = float(sys.argv[7])
    u4 = float(sys.argv[8])
    p1 = float(sys.argv[9])
    p2 = float(sys.argv[10])
    p3 = float(sys.argv[11])
    p4 = float(sys.argv[12])
    ru1 = float(sys.argv[13])
    ru2 = float(sys.argv[14])
    ru3 = float(sys.argv[15])
    ru4 = float(sys.argv[16])
    rp1 = float(sys.argv[17])
    rp2 = float(sys.argv[18])
    rp3 = float(sys.argv[19])
    rp4 = float(sys.argv[20])
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
    
    #matrice_influence = [[0,influence1_2,influence1_3,influence1_4],[influence1_2,0,influence2_3,influence2_4],[influence1_3,influence2_3,0,influence3_4],[influence1_4,influence2_4,influence3_4,0]]
    #liste = fonction_horrible(s1,u1,p1,ru1,rp1,s2,u2,p2,ru2,rp2,s3,u3,p3,ru3,rp3,s4,u4,p4,ru4,rp4,R,pi,mu,matrice_influence)

    # pour tester le truc entrer : 
    # python3 public/python_script/application_env.py 95 95 95 95 5 5 5 5 0 0 0 0 0 0 0 0 0 0 0 0 10 1 0.1 0.25 0.25 0.25 0.25 0 0 0 0 0 0 
    # python3 python_script/application_env.py 9964.9492310481 9964.9654321322 9964.9905921589 9965.0204496922 22.066571937581 21.980964517671 21.808652046214 21.724154185196 0.29702379227407 0.3685357261746 0.51811328563182 0.57980512788954 0 0 0 0 0 0 0 0.57980512788954 8 1 0.067 10.5 31.5 105.78 152.22 0 0 0 0 0 0


# On va réécrire les fonctions utiles ici pour que ce soit plus simple 
    beta = (R/mu)/ 40000
    T  = np.arange(0,2,1)
    print(beta)
    def systeme_diff(vecteur_condition_initiale,t):
        S01,U01,P01,R0_U1,R0_P1,S02,U02,P02,R0_U2,R0_P2,S03,U03,P03,R0_U3,R0_P3,S04,U04,P04,R0_U4,R0_P4 = vecteur_condition_initiale
        dS1 = - beta * S01 * (U01 + (1-pi)*P01)
        dS2 = - beta * S02 * (U02 + (1-pi)*P02)
        dS3 = - beta * S03 * (U03 + (1-pi)*P03)
        dS4 = - beta * S04 * (U04 + (1-pi)*P04) 
        dR_U1 = mu * U01 
        dR_U2 = mu * U02 
        dR_U3 = mu * U03 
        dR_U4 = mu * U04  
        dR_P1 = mu * P01
        dR_P2 = mu * P02
        dR_P3 = mu * P03
        dR_P4 = mu * P04
        dP1 = ((test11)**(1.5))*(((U01/(U01+R0_U1+S01)))**(1.5)) - mu * P01
        dP2 = ((test12)**(1.5))*(((U02/(U02+R0_U2+S02)))**(1.5)) - mu * P02
        dP3 = ((test21)**(1.5))*(((U03/(U03+R0_U3+S03)))**(1.5)) - mu * P03
        dP4 = ((test22)**(1.5))*(((U04/(U04+R0_U4+S04)))**(1.5)) - mu * P04
        dU1 = -dS1 - mu*U01 - ((test11)**(1.5))*(((U01/(U01+R0_U1+S01)))**(1.5)) + U02 * influence_1_2* beta + U03 * influence_1_3 * beta + U04 * influence_1_4 *beta
        dU2 = -dS2 - mu*U02 - ((test12)**(1.5))*(((U02/(U02+R0_U2+S02)))**(1.5)) + U01 * influence_1_2 * beta + U03 * influence_2_3 * beta+ U04 * influence_2_4*beta 
        dU3 = -dS3 - mu*U03 - ((test21)**(1.5))*(((U03/(U03+R0_U3+S03)))**(1.5)) + U01 * influence_1_3 * beta+ U02 * influence_2_3 * beta + U04 * influence_3_4*beta
        dU4 = -dS4 - mu*U04 - ((test22)**(1.5))*(((U04/(U04+R0_U4+S04)))**(1.5)) + U01 * influence_1_4 * beta+ U02 * influence_2_4 * beta + U03 * influence_3_4*beta 
        return [dS1,dU1,dP1,dR_U1,dR_P1,dS2,dU2,dP2,dR_U2,dR_P2,dS3,dU3,dP3,dR_U3,dR_P3,dS4,dU4,dP4,dR_U4,dR_P4]
    data = odeint (systeme_diff,[s1,u1,p1,ru1,rp1,s2,u2,p2,ru2,rp2,s3,u3,p3,ru3,rp3,s4,u4,p4,ru4,rp4],T)
    liste = data[1]
    print(data)
    
    message =''
    for element in liste : 
        message = message + str(element) + " "
    f = open('data.txt','w') 
    f.write(message)