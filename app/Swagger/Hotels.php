<?php
/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   schemes={"http"},
 *   @SWG\Info(
 *     title="Hotels API's",
 *     version="1.0.0",
 *     @SWG\Contact(name="Rami Badran", email="ramibadran.82@gmail.com"),
 *   )
 * )
 */

/**
 * @SWG\Post(
 *   path="/token",
 *   summary="Generate API Token",
 *   tags={"Token"},
 *   operationId="token",
 *   @SWG\Parameter(
 *     name="username",
 *     in="formData",
 *     description="client username",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="password",
 *     in="formData",
 *     description="client password",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="USER-IP",
 *     in="header",
 *     description="User ip",
 *     required=true,
 *     type="string"
 *   ),
 *  @SWG\Parameter(
 *     name="USER-DEVICE-AGENT",
 *     in="header",
 *     description="Device agent . EX : IOS,Android",
 *     required=true,
 *     type="string"
 *   ),
 *   
 *   @SWG\Response(response=201, description="success response with custom message"),
 *   @SWG\Response(response=200, description="success response and token not created with custom message"),
 *   @SWG\Response(response=401, description="unauthorized operation with custom message"),
 *   @SWG\Response(response=412, description="precondition failed with custom message"),
 *   @SWG\Response(response=503, description="service unavailable with custom message")
 * )
 *
 */

/**
 * @SWG\Get(
 *   path="/hotels",
 *   summary=" hotels from third-part providers based on users filter queries",
 *   tags={"Hotels"},
 *   operationId="getHotels",
 *   @SWG\Parameter(
 *     name="city",
 *     in="query",
 *     description="IATA code (AMM),use my sample AMM",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="fromDate",
 *     in="query",
 *     description="date from,format ISO_LOCAL_DATE,use my sample 2019-2-12",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="toDate",
 *     in="query",
 *     description="date to,format ISO_LOCAL_DATE,use my sample 2019-2-15",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="numberOfAdults",
 *     in="query",
 *     description="number of adults,use my sample 2",
 *     required=true,
 *     type="integer"
 *   ),
 *   @SWG\Parameter(
 *     name="Authorization",
 *     in="header",
 *     description="Bearer token",
 *     required=true,
 *     type="string"
 *   ),
 *
 *   @SWG\Response(response=200, description="success response with custom message"),
 *   @SWG\Response(response=401, description="unauthorized operation with custom message"),
 *   @SWG\Response(response=503, description="service unavailable with custom message")
 * )
 *
 */