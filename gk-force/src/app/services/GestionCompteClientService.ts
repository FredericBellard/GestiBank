import {HttpClient}  from "@angular/common/http";
import {GestionCompteClient} from "../modeles/GestionCompteClient";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class GestionCompteClientService
{
    private apiUrl='http://localhost/GestionCompteClient';

    constructor(private http: HttpClient){}

    findAll():Observable<GestionCompteClient[]>
    {
        return this.http.get<GestionCompteClient[]>(this.apiUrl);
    }

    findCompteClientById(id):Observable<GestionCompteClient[]>
    {
         return this.http.get<GestionCompteClient[]>("http://localhost/GestionCompteClient/client.id_client="+id);
        
    }


}