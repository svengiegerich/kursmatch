# create single and couple preference matrices

createPrefmat <- function(prefs) {

# generate clean ranks, sort data frame accordingly
prefs$combi <- (prefs$pr_kind==2)*1
prefs <- prefs[order(prefs$id_from),]
prefs$rank_clean <- unlist(by(prefs$rank, prefs$id_from, FUN = rank))
prefs <- prefs[order(prefs$id_from, prefs$rank_clean),]

# generate IDs consistent with hri2sat requirement
ID_mapping <- aggregate(prefs[,c('combi','rank_clean')], by=list(id_from=prefs$id_from), FUN=max, na.rm=T)
names(ID_mapping)[3] <- 'nPrefs'
ID_mapping <- ID_mapping[order(ID_mapping$combi),]
nSinglePrefs <- sum(ID_mapping$combi==0, na.rm=T)
nCombiPrefs  <- nrow(ID_mapping)-nSinglePrefs
ID_mapping$idx <- 1:nrow(ID_mapping)
ID_mapping$ID1[ID_mapping$combi==0] <-ID_mapping$idx[ID_mapping$combi==0]
if (nCombiPrefs>0) {
  ID_mapping$ID1[ID_mapping$combi==1] <- seq.int((nSinglePrefs+1), (nSinglePrefs+2*nCombiPrefs-1), by=2)
  ID_mapping$ID2[ID_mapping$combi==1] <- ID_mapping$ID1[ID_mapping$combi==1]+1
} else {
  ID_mapping$ID2 <- NA
}
ID_mapping$idx <- NULL

maxnPrefs <- max(ID_mapping$nPrefs, na.rm=T)
prefs$combi <- NULL
matcher <- match(prefs$id_from, ID_mapping$id_from)
prefs <- cbind(prefs, ID_mapping[matcher, c('combi','nPrefs','ID1','ID2')])
#prefs <- left_join(x=prefs, y=ID_mapping, by='id_from')


prefs <- prefs[order(prefs$combi, prefs$ID1, prefs$rank_clean),]

# single preferences (matrix format)

if (sum(prefs$combi==0, na.rm=T)>0) {
  s.prefs <- split(prefs$id_to_1[prefs$combi==0], prefs$ID1[prefs$combi==0])
  nas <- max(unlist(lapply(s.prefs, function(z) length(unique(z)) )))
  s.prefs <- lapply(s.prefs, function(z){
    z <- unique(z)
    c(z, rep(NA,nas-length(z)))
  })
  s.prefs <- do.call(cbind,s.prefs)
} else {
  s.prefs <- NULL
}

# couple preferences (long format)

if (nCombiPrefs>0) {
  co.prefs <- prefs[prefs$combi==1, c('ID1','ID2','id_to_1','id_to_2')]
  # inster 'permuted' couple preferences into here
  i = 1
  while (TRUE) {
    if (!is.na(co.prefs[i,'id_to_2'])) {
      newline <- co.prefs[i,c(1,2,4,3)]
      names(newline) <- names(co.prefs)
      if (i<nrow(co.prefs)) {
        co.prefs <- rbind(co.prefs[1:i,], newline, co.prefs[(i+1):nrow(co.prefs),])
      } else {
        co.prefs <- rbind(co.prefs, newline)
      }
      i = i+1
    }
    i = i+1
    if (i>nrow(co.prefs)) break
  }
  co.prefs <- co.prefs[!duplicated(co.prefs),] # need to ensure that - students could have already ranked A,B and B,A
  co.prefs <- as.matrix(co.prefs)
  rownames(co.prefs) <- NULL
} else {co.prefs <- NULL}

return(list(s.prefs=s.prefs, co.prefs=co.prefs, ID_mapping=ID_mapping))
}

# test it
prefs <- read.csv('./Data/preferences.csv', header=F, stringsAsFactors = F)
names(prefs) <- c('rid','id_to_1','id_to_2','pr_kind','rank','status','created_at','updated_at','id_from')
prefs$id_to_2 <- as.numeric(prefs$id_to_2)
prefs <- prefs[prefs$status==1,]

prefmat <- createPrefmat(prefs)