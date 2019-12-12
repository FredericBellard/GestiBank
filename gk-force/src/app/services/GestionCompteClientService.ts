import {HttpClient, HttpParams}  from "@angular/common/http";
import {GestionCompteClient} from "../modeles/GestionCompteClient";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class GestionCompteClientService
{
    private apiUrl='http://localhost/GestionCompteClient.php';
    params=new HttpParams();
    

    constructor(private http: HttpClient){}

    findAll():Observable<GestionCompteClient[]>
    {
        return this.http.get<GestionCompteClient[]>(this.apiUrl);
    }

    findCompteClientById(id):Observable<GestionCompteClient[]>
    {  
        return this.http.get<GestionCompteClient[]>(this.apiUrl,{params:{id_client:id}});       
    }


}