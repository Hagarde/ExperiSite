import numpy as np 
import matplotlib.pyplot as plt
import scipy.optimize
from scipy.integrate import solve_ivp


NN = 10000
DD = 28
R = 4

kappa =  R / DD
pi = 1
epsilon = 0.01
mu = 1/DD
i0 = 0.005 * NN
nmbr_test = epsilon * NN

S,u,Ru,Rp,P= NN -i0 , i0,0,0,0
beta = (R/mu)/ 10000

alpha = 2
psi = 1

time_limit = 200

#fonction qui affichet les conditions autour de epsilon 
def graphe_epsilon():
    def f(_epsilon):
        return (_epsilon**alpha) * (NN**(alpha-psi)) * i0**(psi-1) * DD - ((kappa * DD * (NN-i0))/NN)
    def g(_epsilon) :
        return 1 - ((_epsilon*NN)**(alpha-1)) * (1 - i0/NN )**(1-psi)
    # On cherche l'antécdent de zéro de f pour tjrs bien adapter la fenêtre 
    zero = scipy.optimize.broyden1(f,[0.006])
    T = np.arange(0,zero*1.1,0.0001)
    X = f(T)
    Y = g(T)
    plt.plot(T,X)
    plt.plot(T,Y)
    plt.show()

# Appellons la fonction si on veut 
#graphe_epsilon()

def evolution_alt(nmbr_test):
    vecteur_condition_initiale = [NN-i0,i0,0,0,0]
    def sys_equa(t,vecteur_condition_initiale) :

        S,U,R_u,R_p,P = vecteur_condition_initiale[0],vecteur_condition_initiale[1],vecteur_condition_initiale[2],vecteur_condition_initiale[3],vecteur_condition_initiale[4]
        dS = - beta * S * U * ((1-pi)*P)
        dU = - dS - (U/DD) + (nmbr_test**alpha) * ((U/(U+S+R_u))**psi)
        dP = (nmbr_test**alpha) * ((U/(U+S+R_u))**psi) - P / DD
        dR_u = U / DD
        dR_p = P / DD
        if (dP > nmbr_test) :
            dP = nmbr_test
        return [dS,dU,dP,dR_u,dR_p]
    
    data = solve_ivp(sys_equa, [0, time_limit],vecteur_condition_initiale,method='DOP853',t_eval=np.arange(0,time_limit,1))
    data = data.y / NN
    Undetected = data[1]
    Positive = data[2]



    T = np.arange(0,time_limit,1)
    fig, ax = plt.subplots(nrows=1, ncols=1)
    U ,= ax.plot(T, Undetected , marker='+', color='red', label='U0')
    P ,= ax.plot(T, Positive, marker='+', color='yellow', label='P0')

    ax.set(xlabel='Temps (en jours)', ylabel='Proportion de la population', title="Evolution continu pour beta = "+ str(beta)+ " / pi = " + str(pi) + " / DD = " + str(DD))
    plt.legend([U,P], [ 'U', 'P'], loc='best')
    plt.show()

def comparatif (nmbr_test) :
    evolution_alt(nmbr_test)
    evolution_alt(0)

comparatif(nmbr_test)