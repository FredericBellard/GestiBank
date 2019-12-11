import {HttpClient, HttpParams}  from "@angular/common/http";
import {GestionCompteClientDetail} from "../modeles/GestionCompteClientDetail";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class GestionCompteClientDetailService
{
    private apiUrl='http://localhost/GestionCompteClientDetail';
    params=new HttpParams();
    

    constructor(private http: HttpClient){}

    findAll():Observable<GestionCompteClientDetail[]>
    {
        return this.http.get<GestionCompteClientDetail[]>(this.apiUrl);
    }

    findCompteClientById(id):Observable<GestionCompteClientDetail[]>
    { 
        return this.http.get<GestionCompteClientDetail[]>(this.apiUrl,{params:{id_client:id}});
             
    }


}

