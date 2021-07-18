from flask import Flask,request
from flask_restful import Resource, Api, reqparse
import json
import jwt
import numpy as np

app = Flask(__name__)
api = Api(app)

# Le coin des constante pas si contante 
alpha = 2
psi = 1/2
pas = 1/10
pi = 1 
NN = 10000# population d'une région à vérifier que c'est la pop totale 

# les fonction permettant de calculer ces nombres 
def SURP_4(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,beta,DD,etat_frontiere=3,pas=1/100) :
    S1,U1,P1,RU1,RP1,S2,U2,P2,RU2,RP2,S3,U3,P3,RU3,RP3,S4,U4,P4,RU4,RP4 = data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15],data[16],data[17],data[18],data[19]
    condition =0.00001 # Seuil avant pour le nombre d'infecté avant de considérer que l'épidémie est finie
    #calcul des valeurs utiles et nécessaires 

    nmbr_test_alpha1 = nmbr_test1 * pas**(1/alpha)
    nmbr_test_alpha2 = nmbr_test2 * pas**(1/alpha)
    nmbr_test_alpha3 = nmbr_test3 * pas**(1/alpha)# avant c'était (alpha-1/alpha)
    nmbr_test_alpha4 = nmbr_test4 * pas**(1/alpha)

    # kappa (nombre de contact par pers et temps) fixe et indé de la taille de population => chaque région devrait être une fraction des contacts
    # Attention il faut que lessum(intra + 2*inter + soi = 1 )
    if etat_frontiere == 0 : # Situation Isolement totale
        beta_intra = 0
        beta_inter = 0
        beta_soi = beta
    elif etat_frontiere == 1 : # Situation deux tribus soudées 
        beta_intra = beta * (5/100)
        beta_inter = beta * (25/1000)
        beta_soi = beta * (9/10)
    else : # Situation de libre échange 
        beta_intra = beta * (2/10)
        beta_inter = beta * (1/10)
        beta_soi = beta * (6/10)
    
    inf_inter_regionale1 = ((beta_intra* U2) + beta_inter *(U3 +  U4))* S1
    inf_inter_regionale2 = ((beta_intra* U1) + beta_inter *( U3 + U4))* S2
    inf_inter_regionale3 = ((beta_intra* U4) + beta_inter *( U1 + U2))* S3
    inf_inter_regionale4 = ((beta_intra* U3) + beta_inter *(U1 + U2))* S4
    # Système 1 

    if (U1<0.01) and (inf_inter_regionale1<condition) :
        dS1 = 0
        dU1 = 0
        dP1 = 0
        dR_u1 = 0
        dR_p1 = 0
    else :
        dS1 = - beta_soi * S1 * (U1 + ((1-pi)*P1)) - inf_inter_regionale1
        dU1 = beta_soi * S1 * (U1 + ((1-pi)*P1)) - (U1/DD) - (nmbr_test_alpha1**alpha) * ((U1/(U1+S1+RU1))**psi) + inf_inter_regionale1
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
        dS2 = - beta_soi * S2 * (U2 + ((1-pi)*P2)) - inf_inter_regionale2
        dU2 = beta_soi * S2 * (U2 + ((1-pi)*P2)) - (U2/DD) - (nmbr_test_alpha2**alpha) * ((U2/(U2+S2+RU2))**psi) + inf_inter_regionale2
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
        dS3 = - beta_soi * S3 * (U3 + ((1-pi)*P3)) -inf_inter_regionale3
        dU3 = beta_soi * S3 * (U3 + ((1-pi)*P3)) - (U3/DD) - (nmbr_test_alpha3**alpha) * ((U3/(U3+S3+RU3))**psi) +  inf_inter_regionale3
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
        dS4 = - beta_soi * S4 * (U4 + ((1-pi)*P4)) -inf_inter_regionale4
        dU4 = beta_soi * S4 * (U4 + ((1-pi)*P4)) - (U4/DD) - (nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**psi) + inf_inter_regionale4
        dP4 = (nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**psi) - P4 / DD
        dR_u4 = U4 / DD
        dR_p4 = P4 / DD
        if ((nmbr_test_alpha4**alpha) * ((U4/(U4+S4+RU4))**(psi))> nmbr_test4) :
            dP4 = nmbr_test4- P4/DD
            dU4 = -dS4-U4/DD + nmbr_test4

    return np.array([dS1,dU1,dP1,dR_u1,dR_p1,dS2,dU2,dP2,dR_u2,dR_p2,dS3,dU3,dP3,dR_u3,dR_p3,dS4,dU4,dP4,dR_u4,dR_p4])

def demain(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,etat_front,pas,beta,DD) :
    indicateur = int(1/pas)
    data = np.array(data)
    for i in range (int(1/pas)) :
        data = data + SURP_4(data,nmbr_test1,nmbr_test2,nmbr_test3,nmbr_test4,beta,DD,etat_front,pas)
    return data,indicateur 

# Le coin API ( j'envoie quoi, à qui, quand ? )

class Region(Resource) :
    def get(self,donnee_encodee): 
        donnee = jwt.decode(donnee_encodee,"Victor est le boss !",algorithms=["HS256"])
        beta = ((donnee["R0"]*pas)*donnee["mu"])/NN
        DD= 1/donnee["mu"]
        data = [donnee["s1"],donnee["u1"],donnee["p1"],donnee["ru1"],donnee["rp1"],donnee["s2"],donnee["u2"],donnee["p2"],donnee["ru2"],donnee["rp2"],donnee["s3"],donnee["u3"],donnee["p3"],donnee["ru3"],donnee["rp3"],donnee["s4"],donnee["u4"],donnee["p4"],donnee["ru4"],donnee["rp4"]]
        datafuture,test = demain(data,donnee["test11"],donnee["test12"],donnee["test21"],donnee["test22"],donnee["niveau_liberte"],pas,beta,DD)
        alternative = [
            {
                "s1" : float(datafuture[0]),
                "u1" : float(datafuture[1]),
                "p1" : float(datafuture[2]),
                "ru1" : float(datafuture[3]),
                "rp1" : float(datafuture[4]),
                "s2" : float(datafuture[5]),
                "u2" : float(datafuture[6]),
                "p2" : float(datafuture[7]),
                "ru2" : float(datafuture[8]),
                "rp2" : float(datafuture[9]),
                "s3" : float(datafuture[10]),
                "u3" : float(datafuture[11]),
                "p3" : float(datafuture[12]),
                "ru3" : float(datafuture[13]),
                "rp3" : float(datafuture[14]),
                "s4" : float(datafuture[15]),
                "u4" : float(datafuture[16]),
                "p4" : float(datafuture[17]),
                "ru4" : float(datafuture[18]),
                "rp4" : float(datafuture[19])
            }
        ]
        return alternative

api.add_resource(Region,"/<string:donnee_encodee>")

if __name__ == "__main__" :
    app.run(debug=True)
        