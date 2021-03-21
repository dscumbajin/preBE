CREATE PROCEDURE PA_REG_PRES_ANIO(IN codVen VARCHAR(50), IN codLinea VARCHAR(50), IN anio YEAR, 
IN ventasPresU INT(11), IN promoPresU INT(11), IN garantPresU INT(11), IN totalPresU INT(11))
INSERT INTO presupuesto_anio(codVen, codLinea, anio, ventasPresU, promoPresU, garantPresU,totalPresU)
VALUES(codVen, codLinea, anio, ventasPresU, promoPresU, garantPresU,totalPresU)



CREATE PROCEDURE PA_REG_PRES_MES(IN idPresAnio INT(11), IN mes DATE, IN cantMesU INT(11), 
IN cantPromoU INT(11), IN cantGarantU INT(11), IN cantTotalU INT(11), IN presMesV DOUBLE)
INSERT INTO presupuesto_mes(idPresAnio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU,presMesV)
VALUES(idPresAnio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU,presMesV)

