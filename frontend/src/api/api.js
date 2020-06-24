import api from './index'
const version = 'api/v1'

// 提交项目表单
export const postProgram = (data) => {
  return api.post(`${version}/program`, data)
}

export const postScore = (programID, data) => {
  return api.put(`${version}/program/${programID}`, data)
}

export const getUsers = () => {
  return api.get(`${version}/user`)
}
export const getProgramList = (campaignID) => {
  return api.get(`${version}/campaign/${campaignID}`)
}

export const postCampaignVote = (campaignID) => {
  return api.post(`${version}/campaign/${campaignID}/vote`)
}

export const getLatestCampaign = () => {
  return api.get(`${version}/campaign/latest`)
}

export const getCampaigns = (parameter) => {
  return api.get(`${version}/campaign/list`, parameter)
}

export const getCampaignRaters = (campaignUID) => {
  return api.get(`${version}/campaign/${campaignUID}/rater`)
}

export const saveRule = (campaignUID, data) => {
  return api.put(`${version}/campaign/${campaignUID}/rule`, data)
}

export const updateCampaign = (campaignUID, data) => {
  return api.put(`${version}/campaign/${campaignUID}`, data)
}

export const createCampaign = (data) => {
  return api.post(`${version}/campaign`, data)
}

export const hideCampaign = (campaignUID) => {
  return api.delete(`${version}/campaign/${campaignUID}`)
}

export const login = (data) => {
  return api.post(`${version}/login`, data)
}

export const getResultData = (campaignUID) => {
  return api.get(`${version}/campaign/${campaignUID}/result`)
}
