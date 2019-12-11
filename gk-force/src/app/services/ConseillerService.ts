import {HttpClient, HttpHeaders, HttpErrorResponse}  from "@angular/common/http";
import {Conseiller} from "../modeles/Conseiller";
import {Observable, throwError} from "rxjs";
import {Injectable} from "@angular/core";
import { tap, catchError } from 'rxjs/operators';

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class ConseillerService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private conseillerUrl='http://localhost/gkForce/conseiller.php';

    constructor(private http: HttpClient){}


  findAll(): Observable<Conseiller[]> {
    return this.http.get<Conseiller[]>(this.conseillerUrl);
  }


  getConseiller(nomConseiller: string): Observable<Conseiller | undefined> {
    var newUrl = this.conseillerUrl+"/"+nomConseiller;
    console.log (newUrl);
    return this.http.get<Conseiller>(this.conseillerUrl+"/"+ nomConseiller);
    
    /*getObservableConseillers()
      .pipe(
        map((conseillers: Conseiller[]) => conseillers.find(p => p.id_user === 1))
      ); 
      */
  }

  updateConseiller(conseiller:Conseiller):Observable<Conseiller>{
    // var newUrl=this.conseillerUrl+"/conseiller";
    //console.log (newUrl);
    return this.http.put<Conseiller>(this.conseillerUrl,conseiller);
  } 


  saveConseiller(conseiller: Conseiller): Observable<Conseiller> {
    console.log('start save conseiller service');
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type':  'multipart/formdata',
        'Access-Control-Allow-Methods': '*'
      })};
    return this.http.post<Conseiller>(this.conseillerUrl, conseiller)
      .pipe(
        tap(data => console.log('All: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  private handleError(err: HttpErrorResponse) {
    let errorMessage = '';
    if (err.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      errorMessage = `An error occurred: ${err.error.message}`;
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      errorMessage = `Server returned code: ${err.status}, error message is: ${err.message}`;
    }
    console.error(errorMessage);
    return throwError(errorMessage);
  }

}