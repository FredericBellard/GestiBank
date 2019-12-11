export class Utilisateur
{ 
    id_user : number;
    nom : string;
    prenom : string;
    email : string;
    pseudonyme : string;
    password : string;
    role : number;

    constructor(id_user : number, nom : string, prenom : string, 
        email : string,pseudonyme : string, password : string , role : number)
    {
        this.id_user = id_user;
        this.nom=nom;
        this.prenom=prenom;
        this.email=email;
        this.pseudonyme=pseudonyme;
        this.password=password;
        this.role=role;    
    }
}